<?php
class CropAvatar {
	private $src;
	private $name;
	private $img_tags;
	private $data;
	private $dst;
	private $type;
	private $extension;
	private $msg;
	private $fileName;
	private $cropBoxWidth;
	private $cropBoxHeight;
	private $path;

	private $resizedFileName = array();
	private $resizeList = array(
		array("width" => 1600, "height" => 900),
		array("width" => 1280, "height" => 720),
		array("width" => 615, "height" => 346),
		array("width" => 300, "height" => 169),
		array("width" => 100, "height" => 56),
		array("width" => 77, "height" => 43),
	);

	function __construct($src, $data, $file, $operation, $imgname, $imgtags, $imgDetails, $destFile) {
		$this->path = strtolower('images/' . date('Y/M-d') . '/');
		$this->setImageParams($imgname, $imgtags);
		$this->setSrc($src);
		$this->setData($data);
		if ($operation == 'resize') {
			$this->setFile($file);
			$this->resize($this->src, $this->dst);
		} else {
			$this->fileName = substr($imgDetails[0]['image_original'], 1);
			$this->setSrc(substr($imgDetails[0]['image_original'], 1));
			$this->dst = substr($imgDetails[0]['image_' . $destFile], 1);
			$this->setCropSize($destFile);
			$this->crop($this->src, $this->dst, $this->data);

		}
	}
	private function setCropSize($size) {
		switch ($size) {
			case '1280':
				$this->cropBoxWidth = 1280;
				$this->cropBoxHeight = 720;
				break;
			case '615':
				$this->cropBoxWidth = 615;
				$this->cropBoxHeight = 346;
				break;
			case '300':
				$this->cropBoxWidth = 300;
				$this->cropBoxHeight = 169;
				break;
			case '100':
				$this->cropBoxWidth = 100;
				$this->cropBoxHeight = 56;
				break;
			case '77':
				$this->cropBoxWidth = 77;
				$this->cropBoxHeight = 43;
				break;
		}
	}
	private function setImageParams($imgname, $imgtags) {
		$this->name = $imgname;
		$this->img_tags = $imgtags;
	}

	private function setSrc($src) {
		if (!empty($src)) {
			$type = exif_imagetype($src);

			if ($type) {
				$this->src = $src;
				$this->type = $type;
				$this->extension = image_type_to_extension($type);
				$this->setDst();
			}
		}
	}

	private function setData($data) {
		if (!empty($data)) {
			$this->data = json_decode(stripslashes($data));
		}
	}

	private function setFile($file) {
		$errorCode = $file['error'];

		if ($errorCode === UPLOAD_ERR_OK) {
			$type = exif_imagetype($file['tmp_name']);

			if ($type) {
				$extension = image_type_to_extension($type);
				if (!is_dir($this->path)) {
					mkdir($this->path, 0755, true);
				}
				$src = $this->path . $this->name . '-original' . $extension;
				$this->fileName = $this->path . $this->name;
				if (file_exists($src)) {
					$this->name = date('YmdHis-') . $this->name;
					$src = $this->path . $this->name . '-original' . $extension;
					$this->fileName = $this->path . $this->name;
				}
				if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

					if (file_exists($src)) {
						unlink($src);
					}

					$result = move_uploaded_file($file['tmp_name'], $src);

					if ($result) {
						$this->src = $src;
						$this->type = $type;
						$this->extension = $extension;
						$this->setDst();
					} else {
						$this->msg = 'Failed to save file';
					}
				} else {
					$this->msg = 'Please upload image with the following types: JPG, PNG, GIF';
				}
			} else {
				$this->msg = 'Please upload image file';
			}
		} else {
			$this->msg = $this->codeToMessage($errorCode);
		}
	}

	private function setDst() {
		$this->dst = $this->path . $this->name . $this->extension;
	}
	private function resize($src, $dst) {
		if (!empty($src) && !empty($dst)) {
			switch ($this->type) {
				case IMAGETYPE_GIF:
					$src_img = imagecreatefromgif($src);
					break;

				case IMAGETYPE_JPEG:
					$src_img = imagecreatefromjpeg($src);
					break;

				case IMAGETYPE_PNG:
					$src_img = imagecreatefrompng($src);
					break;
			}
			if (!$src_img) {
				$this->msg = "Failed to read the image file";
				return;
			}
			$size = getimagesize($src);
			$size_w = $size[0]; // natural width
			$size_h = $size[1]; // natural height
			foreach ($this->resizeList as $key => $resizeDimension) {
				$dst_img_w = $resizeDimension['width'];
				$dst_img_h = $resizeDimension['height'];
				$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);
				imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
				imagesavealpha($dst_img, true);
				$result = imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dst_img_w, $dst_img_h, $size_w, $size_h);

				if ($result) {
					$fileName = $this->fileName . "_" . $dst_img_w . $this->extension;
					$resized = true;
					switch ($this->type) {
						case IMAGETYPE_GIF:
							if (!imagegif($dst_img, $fileName)) {
								$this->msg = "Failed to save the cropped image file";
								$resized = false;
							}
							break;

						case IMAGETYPE_JPEG:
							if (!imagejpeg($dst_img, $fileName, 72)) {
								$this->msg = "Failed to save the cropped image file";
								$resized = false;
							}
							break;

						case IMAGETYPE_PNG:
							if (!imagepng($dst_img, $fileName)) {
								$this->msg = "Failed to save the cropped image file";
								$resized = false;
							}
							break;
					}
					if ($resized == true) {
						$this->resizedFileName[$dst_img_w] = '/' . $fileName;
					}
				} else {
					$this->msg = "Failed to crop the image file";
				}
				imagedestroy($dst_img);
			}
			imagedestroy($src_img);
		}
	}
	private function crop($src, $dst, $data) {
		if (!empty($src) && !empty($dst) && !empty($data)) {
			switch ($this->type) {
				case IMAGETYPE_GIF:
					$src_img = imagecreatefromgif($src);
					break;

				case IMAGETYPE_JPEG:
					$src_img = imagecreatefromjpeg($src);
					break;

				case IMAGETYPE_PNG:
					$src_img = imagecreatefrompng($src);
					break;
			}

			if (!$src_img) {
				$this->msg = "Failed to read the image file";
				return;
			}

			$size = getimagesize($src);
			$size_w = $size[0]; // natural width
			$size_h = $size[1]; // natural height

			$src_img_w = $size_w;
			$src_img_h = $size_h;

			$degrees = $data->rotate;

			// Rotate the source image
			if (is_numeric($degrees) && $degrees != 0) {
				// PHP's degrees is opposite to CSS's degrees
				$new_img = imagerotate($src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127));

				imagedestroy($src_img);
				$src_img = $new_img;

				$deg = abs($degrees) % 180;
				$arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

				$src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
				$src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

				// Fix rotated image miss 1px issue when degrees < 0
				$src_img_w -= 1;
				$src_img_h -= 1;
			}

			$tmp_img_w = $data->width;
			$tmp_img_h = $data->height;
			$dst_img_w = $this->cropBoxWidth;
			$dst_img_h = $this->cropBoxHeight;

			$src_x = $data->x;
			$src_y = $data->y;

			if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
				$src_x = $src_w = $dst_x = $dst_w = 0;
			} else if ($src_x <= 0) {
				$dst_x = -$src_x;
				$src_x = 0;
				$src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
			} else if ($src_x <= $src_img_w) {
				$dst_x = 0;
				$src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
			}

			if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
				$src_y = $src_h = $dst_y = $dst_h = 0;
			} else if ($src_y <= 0) {
				$dst_y = -$src_y;
				$src_y = 0;
				$src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
			} else if ($src_y <= $src_img_h) {
				$dst_y = 0;
				$src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
			}

			// Scale to destination position and size
			$ratio = $tmp_img_w / $dst_img_w;
			$dst_x /= $ratio;
			$dst_y /= $ratio;
			$dst_w /= $ratio;
			$dst_h /= $ratio;

			$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

			// Add transparent background to destination image
			imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
			imagesavealpha($dst_img, true);

			$result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

			if ($result) {
				switch ($this->type) {
					case IMAGETYPE_GIF:
						if (!imagegif($dst_img, $dst)) {
							$this->msg = "Failed to save the cropped image file";
						}
						break;

					case IMAGETYPE_JPEG:
						if (!imagejpeg($dst_img, $dst, 72)) {
							$this->msg = "Failed to save the cropped image file";
						}
						break;

					case IMAGETYPE_PNG:
						if (!imagepng($dst_img, $dst)) {
							$this->msg = "Failed to save the cropped image file";
						}
						break;
				}
			} else {
				$this->msg = "Failed to crop the image file";
			}

			imagedestroy($src_img);
			imagedestroy($dst_img);
		}
	}

	private function codeToMessage($code) {
		$errors = array(
			UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
			UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
			UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
			UPLOAD_ERR_NO_FILE => 'No file was uploaded',
			UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
			UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
			UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
		);

		if (array_key_exists($code, $errors)) {
			return $errors[$code];
		}

		return 'Unknown upload error';
	}

	public function getResult() {
		return !empty($this->data) ? '/' . $this->dst : '/' . $this->src;
	}

	public function getResizeFileName() {
		return $this->resizedFileName;
	}

	public function getMsg() {
		return $this->msg;
	}
}
?>
