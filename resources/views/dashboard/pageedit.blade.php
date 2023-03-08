@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <div class="card mb-4">
                    <div class="card-header text-uppercase">
                        <a href="/dashboard/pages" class="me-2"><i class="fas fa-arrow-circle-left"></i></a>
                        {{ $title_bar }}
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/dashboard/pages/{{ $page->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Judul</label>
                                <input class="form-control mt-1 @error('title') is-invalid @enderror" name="title"
                                    type="text" id="title" value="{{ old('title', $page->title) }}" />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <img src="{{ $page->image ? '/storage/' . $page->image : '/assets/img/noimage.jpeg' }}"
                                        class="img-thumbnail imagePreview" width="100px">
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <div class="input-group">
                                            <input type="file" name="image" id="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                onchange="previewImage('image', 'imagePreview')">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="body">Konten</label>
                                <textarea class="ckeditor form-control @error('body') is-invalid @enderror" name="body" id="body">{{ old('body', $page->body) }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var HOST = "/dashboard/pages/upload"; //pass the route

            addEventListener("trix-attachment-add", function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment)
                }
            })

            function uploadFileAttachment(attachment) {
                uploadFile(attachment.file, setProgress, setAttributes)

                function setProgress(progress) {
                    attachment.setUploadProgress(progress)
                }

                function setAttributes(attributes) {
                    attachment.setAttributes(attributes)
                }
            }

            function uploadFile(file, progressCallback, successCallback) {
                var formData = createFormData(file);
                var xhr = new XMLHttpRequest();

                xhr.open("POST", HOST, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', getMeta('csrf-token'));

                xhr.upload.addEventListener("progress", function(event) {
                    var progress = event.loaded / event.total * 100
                    progressCallback(progress)
                })

                xhr.addEventListener("load", function(event) {
                    var attributes = {
                        url: xhr.responseText,
                        href: xhr.responseText + "?content-disposition=attachment"
                    }
                    successCallback(attributes)
                })

                xhr.send(formData)
            }

            function createFormData(file) {
                var data = new FormData()
                data.append("Content-Type", file.type)
                data.append("file", file)
                return data
            }

            function getMeta(metaName) {
                const metas = document.getElementsByTagName('meta');

                for (let i = 0; i < metas.length; i++) {
                    if (metas[i].getAttribute('name') === metaName) {
                        return metas[i].getAttribute('content');
                    }
                }

                return '';
            }
        })();
    </script>
@endsection

@section('script')
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();
                xhr.open('POST', "{{ route('image-upload', ['_token' => csrf_token()]) }}", true);
                xhr.responseType = 'json';
            }

            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }
                    resolve(response);
                });

                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            _sendRequest(file) {
                const data = new FormData();
                data.append('upload', file);
                this.xhr.send(data);
            }
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'alignment', 'indent', 'outdent', '|',
                    'bulletedList', 'numberedList', , '|', 'fontSize', 'fontColor', '|', 'blockQuote',
                    'horizontalLine', '|', 'insertTable', 'imageUpload', 'mediaEmbed', 'link', '|', 'removeFormat',
                    'code', '|', 'undo', 'redo'
                ],
                extraPlugins: [MyCustomUploadAdapterPlugin]
            }).then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('height', '500px', editor.editing.view.document.getRoot());
                });
                editor.config.define('mediaEmbed', {
                    providers: [{
                            name: 'youtube',
                            url: [
                                /^(?:m\.)?youtube\.com\/watch\?v=([\w-]+)/,
                                /^(?:m\.)?youtube\.com\/v\/([\w-]+)/,
                                /^youtube\.com\/embed\/([\w-]+)/,
                                /^youtu\.be\/([\w-]+)/
                            ],
                            html: match => {
                                const id = match[1];
                                return (
                                    '<div style="position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;">' +
                                    `<iframe src="https://www.youtube.com/embed/${id}" ` +
                                    'style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;" ' +
                                    'frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>' +
                                    '</iframe>' +
                                    '</div>'
                                );
                            }
                        },
                        {
                            name: 'instagram',
                            url: /^instagram\.com\/p\/(\w+)/
                        },
                        {
                            name: 'twitter',
                            url: /^twitter\.com/
                        },
                        {
                            name: 'googleMaps',
                            url: /^google\.com\/maps/
                        },
                        {
                            name: 'facebook',
                            url: /^facebook\.com/
                        }
                    ]
                });
            });
    </script>
@endsection
