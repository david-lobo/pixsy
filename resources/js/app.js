/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import Mustache from 'mustache';
import Dropzone from 'dropzone';
import toastr from 'toastr';
require('imagesloaded/imagesloaded.pkgd');
require('masonry-layout/dist/masonry.pkgd');
require('infinite-scroll/dist/infinite-scroll.pkgd');
require('ekko-lightbox/dist/ekko-lightbox');

let app, page, $grid, msnry, pagination;

class PostForm {
    init() {
        //
    }

    static initDropzone() {
        var uploadedDocumentMap = {}
        Dropzone.options.mediaDropzone = {
            url: config['routes']['posts.storeMedia'],
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                if (typeof response !== 'undefined') {
                    $('form').append('<input type="hidden" name="media[]" value="' + response.name + '">')
                    uploadedDocumentMap[file.name] = response.name
                }
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="media[]"][value="' + name + '"]').remove()
            },
            init: function() {
                if (typeof files !== 'undefined') {
                    for (let i in files) {
                        let file = files[i];
                        let mockFile = {
                            name: file.name,
                            size: file.size
                        };

                        this.options.addedfile.call(this, mockFile);
                        this.options.thumbnail.call(this, mockFile, "https://picsum.photos/800");
                        this.options.complete.call(this, mockFile);
                        this.options.processing.call(this, mockFile);
                        this.options.success.call(this, mockFile);
                        $('form').append('<input type="hidden" name="media[]" value="' + file.file_name + '">')
                    }
                }
            }
        }
    }
}

class PostsPage {
    init() {
        pagination = {};

        let all = this.getQueryParam('all');

        pagination.next_page_url = config['routes']['posts.get'];

        if (all) {
            pagination.next_page_url += '?all=' + all;
        }

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({

            });
        });

        this.initMasonry();

        this.initInfiniteScroll();
    }

    getQueryParam(param) {
        var urlParams = new URLSearchParams(location.search);

        urlParams.has('type');  // true
        urlParams.get('id');    // 1234
        urlParams.getAll('id'); // ["1234"]
        urlParams.toString();   // type=product&id=1234

        if (urlParams.has(param)) {
            return urlParams.get('all');
        }

        return false;
    }
    initMasonry() {
        $grid = $('.gallery-wrapper').masonry({
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true,
            transitionDuration: 0,
            stagger: 30,
            // nicer reveal transition
            visibleStyle: {
                transform: 'translateY(0)',
                opacity: 1
            },
            hiddenStyle: {
                transform: 'translateY(100px)',
                opacity: 0
            },
        });

        msnry = $grid.data('masonry');
    }

    initInfiniteScroll() {
        $grid.infiniteScroll({
            // options
            path: function() {
                //var pageNumber = ( this.loadCount + 1 ) * 10;
                if (pagination.next_page_url !== false) {

                    return pagination.next_page_url;
                }

                return false;

            },
            append: false,
            debug: true,
            responseType: 'text',
            prefill: false,
            history: false,
            outlayer: msnry,
            //hideNav: '.pagination',
            status: '.page-load-status',
        }).infiniteScroll('loadNextPage');

        $grid.on('request.infiniteScroll', function(event, path) {
            //console.log('Loading page: ' + path);
        });

        $grid.on('load.infiniteScroll', function(event, response) {
            let data = JSON.parse(response);
            let newItems = '';

            $('.pagination__next').remove();

            if (data.payload.next_page_url === null) {
                pagination.next_page_url = false;
            } else {
                pagination.next_page_url = data.payload.next_page_url;
            }

            $(data.payload.data).each(function(i, v) {
                let template = $('#mustacheTemplate_gallery_item').html();
                let html = Mustache.to_html(template, {
                    post: v,
                    images: v.images[0]
                });
                newItems += html;
            });

            var $items = $(newItems);

            $items.imagesLoaded().always(function(instance) {
                   // console.log('all images loaded');
                    $grid.infiniteScroll('appendItems', $items)
                        .masonry('appended', $items);
                })
                .done(function(instance) {
                    //console.log('all images successfully loaded');

                })
                .fail(function() {
                    //console.log('all images loaded, at least one is broken');
                })
                .progress(function(instance, image) {
                    let result = image.isLoaded ? 'loaded' : 'broken';
                    //console.log('image is ' + result + ' for ' + image.img.src);
                });
        });
    }
}

class App {
    constructor() {
        this.page
    }

    static preload() {
        App.initCSRFToken();
        if (config.hasOwnProperty('route')) {
            if (config.route === 'posts.create' || config.route === 'posts.edit') {
                PostForm.initDropzone();
            }
        }
    }

    init() {
        this.showFlashMessage();

        if (config.hasOwnProperty('route')) {
            if (config.route === 'home') {
                page = new PostsPage();

            } else if (config.route === 'posts.create' || config.route === 'posts.edit') {
                page = new PostForm();
            }
            if (typeof page !== 'undefined') {
                page.init();
                config.page = page;
            }
        }
    }

    showFlashMessage() {
        if (typeof config.flash_message !== 'undefined') {
            toastr.success(config.flash_message);
        }
    }

    static initCSRFToken() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
}

App.preload();

$(document).ready(function() {
    app = new App();
    app.init();
});
