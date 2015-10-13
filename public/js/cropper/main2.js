  function ImageUploader($element) {
    this.$container = $element;

    /*this.$avatarView = this.$container.find('.avatar-view');*/
    /*this.$avatar = this.$avatarView.find('img');*/
    this.$imgModal = this.$container.find('#img-modal');
    this.$loading = this.$container.find('.loading');

    this.$imgForm = this.$imgModal.find('.img-form');
    this.$imgUpload = this.$imgForm.find('.img-upload');
    this.$imgSrc = this.$imgForm.find('.img-src');
    this.$imgData = this.$imgForm.find('.img-data');
    this.$imgInput = this.$imgForm.find('.img-input');
    this.$imgName = this.$imgForm.find('#img_name');
    this.$imgTags = this.$imgForm.find('#img_tags');
    this.$imgSave = this.$imgForm.find('.img-save');

    this.$imgWrapper = this.$imgModal.find('.img-wrapper');
    /*this.$avatarPreview = this.$avatarModal.find('.img-preview');*/

    this.init();
  }

  ImageUploader.prototype = {
    constructor: ImageUploader,
    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;
      if (!this.support.formData) {
        this.initIframe();
      }

      /*this.initTooltip();*/
      /*this.initModal();*/
      this.addListener();
    },

    addListener: function () {
      /*this.$avatarView.on('click', $.proxy(this.click, this));*/
      this.$imgInput.on('change', $.proxy(this.change, this));
      this.$imgForm.on('submit', $.proxy(this.submit, this));
      /*this.$avatarBtns.on('click', $.proxy(this.rotate, this));*/
    },

    /*initTooltip: function () {
      this.$avatarView.tooltip({
        placement: 'bottom'
      });
    },*/

    /*initModal: function () {
      this.$avatarModal.modal({
        show: false
      });
    },*/

    /*initPreview: function () {
      var url = this.$avatar.attr('src');

      this.$avatarPreview.html('<img src="' + url + '">');
    },*/

    initIframe: function () {
      var target = 'upload-img-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;
          try {
            data = $(this).contents().find('body').text();
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$imgForm.attr('target', target).after($iframe.hide());
    },

    /*click: function () {
      this.$avatarModal.modal('show');
      this.initPreview();
    },*/

    change: function () {
      var files;
      var file;

      if (this.support.datauri) {
        files = this.$imgInput.prop('files');

        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.url = URL.createObjectURL(file);
            this.startCropper();
          }
        }
      } else {
        file = this.$imgInput.val();

        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }
    },

    submit: function () {
      if ((!this.$imgSrc.val() && !this.$imgInput.val()) || !this.$imgName.val() || !this.$imgTags.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    /*rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },*/

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$imgWrapper.empty().html(this.$img);
        this.$img.cropper({
          aspectRatio: 16/9,
          autoCrop: false,
          cropBoxResizable:false,
          cropBoxMovable: true,
          dragCrop: false,
          /*preview: this.$imgPreview.selector,*/
          strict: true,
          movable:false,
          crop: function (e) {
            var json = [
                  '{"x":' + e.x,
                  '"y":' + e.y,
                  '"height":' + e.height,
                  '"width":' + e.width,
                  '"rotate":' + e.rotate + '}'
                ].join();

            _this.$imgData.val(json);
          }
        });
        this.active = true;
      }

      this.$imgModal.one('hidden.bs.modal', function () {
        _this.$imgPreview.empty();
        _this.stopCropper();
      });
    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url = this.$imgForm.attr('action');
      var data = new FormData(this.$imgForm[0]);
      data.image_name;
      var _this = this;

      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();
        },

        success: function (data) {
          _this.submitDone(data);
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          _this.submitEnd();
        }
      });
    },

    syncUpload: function () {
      this.$imgSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
          this.url = data.result;
          $.each(data.resizedList, function(key,valueObj){
              $("#img_"+key).attr('src',valueObj);
              var av_1280 =  new CropAvatar($('#crop-avatar-'+key),data.result,key,data.image_id);
          });
          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$imgSrc.val(this.url);
            this.startCropper();
          }
          $("#resize-container").show();


          this.$imgInput.val('');
        } else if (data.message) {
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      this.$imgForm.get(0).reset();
      this.$img.attr('src', this.url);
      this.stopCropper();
      /*this.$imgModal.modal('hide');*/
    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$imgUpload.after($alert);
    }
  };

  $(function () {
    var ImgUploader = new ImageUploader($('#img-uploader'));
  });


  function CropAvatar($element,$Loadimg,$imgKey,$image_id) {
    this.$container = $element;
    this.$imgKey = $imgKey;
    switch(this.$imgKey){
      case '1280':
        this.$cropBoxWidth = 1280;
        this.$cropBoxHeight = 720;
        break;
      case '615':
        this.$cropBoxWidth = 615;
        this.$cropBoxHeight = 346;
        break;
      case '300':
        this.$cropBoxWidth = 300;
        this.$cropBoxHeight = 169;
        break;
      case '100':
        this.$cropBoxWidth = 100;
        this.$cropBoxHeight = 56;
        break;
      case '77':
        this.$cropBoxWidth = 77;
        this.$cropBoxHeight = 43;
        break;
    }

    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$container.find('#avatar-modal');
    this.$loading = this.$container.find('.loading');

    this.$avatarForm = this.$avatarModal.find('.avatar-form');
    this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
    this.$avatarImgId = this.$avatarForm.find('.avatar-image_id');
    this.$avatarWidth = this.$avatarForm.find('.avatar-width');
    this.$avatarSrc = this.$avatarForm.find('.avatar-src');
    this.$avatarData = this.$avatarForm.find('.avatar-data');
    this.$avatarInput = this.$avatarForm.find('.avatar-input');
    this.$avatarSave = this.$avatarForm.find('.avatar-save');
    this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

    this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
    this.$avatarPreview = this.$avatarModal.find('.avatar-preview');
    this.$preLoadimage = $('<img src="'+$Loadimg+'">');
    this.$avatarWrapper.empty().html(this.$preLoadimage);
    console.log('2222');
    this.$avatarWidth.val(this.$imgKey);
    this.$avatarImgId.val($image_id);
    this.init();
  }

  CropAvatar.prototype = {
    constructor: CropAvatar,

    support: {
      fileList: !!$('<input type="file">').prop('files'),
      blobURLs: !!window.URL && URL.createObjectURL,
      formData: !!window.FormData
    },

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;
      if (!this.support.formData) {
        this.initIframe();
      }

      this.initTooltip();
      this.initModal();
      this.addListener();
      //this.customCropper();
    },
    customCropper: function (){
      var _this = this;
      $image = this.$preLoadimage;
        this.$preLoadimage.cropper({
              aspectRatio: 16/9,
              autoCrop: true,
              autoCropArea:0.8,
              cropBoxResizable:false,
              cropBoxMovable: true,
              dragCrop: false,
              //preview: this.$avatarPreview.selector,
              strict: true,
              movable:true,
              crop: function (e) {
                var json = [
                      '{"x":' + e.x,
                      '"y":' + e.y,
                      '"height":' + _this.$cropBoxHeight,
                      '"width":' + _this.$cropBoxWidth,
                      '"rotate":' + e.rotate + '}'
                    ].join();

                _this.$avatarData.val(json);
              },
              built: function (e){
                console.log(_this.$cropBoxHeight)
              $canvasData = $image.cropper('getCanvasData');
              var _top = Math.round(($canvasData.height/2)-(_this.$cropBoxHeight/2));
              var _left = Math.round(($canvasData.width/2)-(_this.$cropBoxWidth/2));
              console.log(_left);
              console.log(_top);
              $image.cropper("setCropBoxData", { top:_top, left:_left, width: _this.$cropBoxWidth, height: _this.$cropBoxHeight });
              },
            });
    },
    addListener: function () {
      this.$avatarView.on('click', $.proxy(this.click, this));
      this.$avatarInput.on('change', $.proxy(this.change, this));
      this.$avatarForm.on('submit', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));
    },

    initTooltip: function () {
      this.$avatarView.tooltip({
        placement: 'bottom'
      });
    },

    initModal: function () {
      this.$avatarModal.modal({
        show: false
      });
    },

    initPreview: function () {
      var url = this.$avatar.attr('src');

      this.$avatarPreview.html('<img src="' + url + '">');
    },

    initIframe: function () {
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
          var data;
          try {
            data = $(this).contents().find('body').text();
          } catch (e) {
            console.log(e.message);
          }

          if (data) {
            try {
              data = $.parseJSON(data);
            } catch (e) {
              console.log(e.message);
            }

            _this.submitDone(data);
          } else {
            _this.submitFail('Image upload failed!');
          }

          _this.submitEnd();

        });
      });

      this.$iframe = $iframe;
      this.$avatarForm.attr('target', target).after($iframe.hide());
    },

    click: function () {
      var _this = this;
      this.$avatarModal.modal('show');
      this.$avatarModal.on('shown.bs.modal', function () {
        _this.customCropper();
        console.log('2222');
      });
      this.initPreview();
    },

    change: function () {
      var files;
      var file;

      if (this.support.datauri) {
        files = this.$avatarInput.prop('files');

        if (files.length > 0) {
          file = files[0];

          if (this.isImageFile(file)) {
            if (this.url) {
              URL.revokeObjectURL(this.url); // Revoke the old one
            }

            this.url = URL.createObjectURL(file);
            this.startCropper();
          }
        }
      } else {
        file = this.$avatarInput.val();

        if (this.isImageFile(file)) {
          this.syncUpload();
        }
      }
    },

    submit: function () {
      /*if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }*/

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
      var data;

      if (this.active) {
        data = $(e.target).data();

        if (data.method) {
          this.$img.cropper(data.method, data.option);
        }
      }
    },

    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper({
          aspectRatio: 16/9,
          autoCrop: true,
          autoCropArea:0.8,
          cropBoxResizable:false,
          cropBoxMovable: true,
          dragCrop: false,
          preview: this.$avatarPreview.selector,
          strict: true,
          movable:true,
          crop: function (e) {
                var json = [
                      '{"x":' + e.x,
                      '"y":' + e.y,
                      '"height":' + e.height,
                      '"width":' + e.width,
                      '"rotate":' + e.rotate + '}'
                    ].join();

                _this.$avatarData.val(json);
              },
          built: function (e){
              $canvasData = _this.$img.cropper('getCanvasData');
              var _top = Math.round(($canvasData.height/2)-(_this.$cropBoxHeight/2));
              var _left = Math.round(($canvasData.width/2)-(_this.$cropBoxWidth/2));
              _this.$img.cropper("setCropBoxData", { top:_top, left:_left, width: _this.$cropBoxWidth, height: _this.$cropBoxHeight });
          },
        });
        this.active = true;
      }

      this.$avatarModal.on('hidden.bs.modal', function () {
        _this.$avatarPreview.empty();
        _this.stopCropper();
      });
    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
      var _this = this;

      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();
        },

        success: function (data) {
          _this.submitDone(data);
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          _this.submitEnd();
        }
      });
    },

    syncUpload: function () {
      this.$avatarSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      if ($.isPlainObject(data) && data.state === 200) {
        if (data.result) {
          this.url = data.result;

          if (this.support.datauri || this.uploaded) {
            this.uploaded = false;
            this.cropDone();
          } else {
            this.uploaded = true;
            this.$avatarSrc.val(this.url);
            this.startCropper();
          }

          this.$avatarInput.val('');

        } else if (data.message) {
          this.alert(data.message);
        }
      } else {
        this.alert('Failed to response');
      }
    },

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      this.$avatarForm.get(0).reset();
      this.$avatar.attr('src', this.url);
      this.stopCropper();
      this.$avatarModal.modal('hide');
    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable">',
              '<button type="button" class="close" data-dismiss="alert">&times;</button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarUpload.after($alert);
    }
  };

 $(function () {
/*    var av_1280 =  new CropAvatar($('#crop-avatar-1280'));
    var av_615 =  new CropAvatar($('#crop-avatar-615'));
    var av_300 =  new CropAvatar($('#crop-avatar-300'));
    var av_100 =  new CropAvatar($('#crop-avatar-100'));
    var av_77 =  new CropAvatar($('#crop-avatar-77'));
*/  });
