(() => {
    "use strict";
    var e = {
        n: (i) => {
            var t = i && i.__esModule ? () => i.default : () => i;
            return e.d(t, {a: t}), t;
        },
        d: (i, t) => {
            for (var r in t) e.o(t, r) && !e.o(i, r) && Object.defineProperty(i, r, {enumerable: !0, get: t[r]});
        },
        o: (e, i) => Object.prototype.hasOwnProperty.call(e, i),
    };
    const i = jQuery;
    var t = e.n(i);
    const r = "jqueryUploader",
        l = "defaultUploaderOptions",
        s = ".jquery-uploader-preview-progress",
        a = "image",
        o = "other",
        n = ["jpg", "png", "jpeg", "gif", "bmp"],
        d = (function () {
            const e = window.URL || window.webkitURL;
            let i = new Map();
            return {
                createBlobUrl: function (t) {
                    let r = e.createObjectURL(t);
                    return i.set(r, t), r;
                },
                revokeBlobUrl: function (t) {
                    e.revokeObjectURL(t), i.delete(t);
                },
                getBlobFromUrl: function (e) {
                    return i.get(e);
                },
            };
        })();

    function u() {
        let e = [],
            i = "0123456789abcdef";
        for (let t = 0; t < 36; t++) e[t] = i.substr(Math.floor(16 * Math.random()), 1);
        return (e[14] = "4"), (e[19] = i.substr((3 & e[19]) | 8, 1)), (e[8] = e[13] = e[18] = e[23] = "-"), e.join("");
    }

    function p(e) {
        if (!e || 0 === e.length) return o;
        if (e.startsWith("blob")) return -1 !== d.getBlobFromUrl(e).type.indexOf("image") ? a : o;
        for (let i of n) if (e.endsWith(i)) return a;
        return o;
    }

    class h {
        constructor(e, i) {
            this.$originEle = e;
            let r = window[l] ? window[l] : {};
            (this.options = t().extend(!0, {}, h.defaults, r, i)), (this.files = []), this.checkOptions(), this.initEle(), this.initEvent();
        }

        checkOptions() {
            if (this.options.mode !== h.mode.url) throw `Not supported mode ${this.options.mode}`;
            if ("text" !== this.$originEle.attr("type") && this.$originEle.attr("type")) throw `url In mode, the type of element can only be text,Cannot be ${this.$originEle.attr("type")}`;
        }

        initEle() {
            if (
                (this.$originEle.css("display", "none"),
                    (this.$selectCard = t()(
                        '<div class="jquery-uploader-select-card">\n                <div class="jquery-uploader-select">\n                    <div class="upload-button">\n                        <i class="mdi mdi-plus fw-bold"></i><br/>\n                        <a>Upload</a>\n                    </div>\n                </div>\n            </div>'
                    )),
                    (this.$uploaderContainer = t()('<div class="jquery-uploader-preview-container" id="sortable"></div>')),
                    (this.$uploader = t()('<div class="jquery-uploader"></div>').append(this.$uploaderContainer)),
                    this.options.parent ? this.options.parent.append(this.$uploader) : this.$originEle.parent().append(this.$uploader),
                this.options.mode === h.mode.url)
            ) {
                let e = this.$originEle.val();
                this.createDefaultFiles(e);
            }
            this.$originEle.trigger("uploader-init");
        }

        createFileCardEle(e, i, r) {
            let l = (r = r || p(i)) === a ? `<img alt="preview" class="files_img" src="${i}"/>` : '<div class="file_other"></div>',
                o = t()(
                    `<div class="jquery-uploader-card" id="${e}">\n
                        <div class="jquery-uploader-preview-main">\n
                            <div class="jquery-uploader-preview-action">\n
                                <ul>\n
                                    \x3c!-- <li class="file-detail"><i class="fa fa-eye"></i></li> !--\x3e\n
                                    <li class="file-delete">
                                        <i class="mdi mdi-trash-can-outline text-danger"></i>
                                    </li>\n
                                </ul>\n
                            </div>\n
                        <div class="jquery-uploader-preview-progress">\n
                            <div class="progress-mask"></div>\n
                            <div class="progress-loading">\n
                                <i class="spinner-border spinner-border-sm"></i>\n
                            </div>\n
                        </div>\n
                        ${l}\n
                        </div>\n
                        <input type="hidden" name="images[${e}]" value=""/>\n
                    </div>`
                );
            return o.find(s).hide(), o;
        }

        fileCardWaring(e) {
            e.css("box-shadow", "0px 0px 3px 1px #f8ac59 inset");
        }

        fileCardError(e) {
            e.css("box-shadow", "0px 0px 3px 1px #ed5565 inset");
        }

        fileCardDefault(e) {
            e.css("box-shadow", "");
        }

        upload() {
            return this.handleFileUpload(), this.$originEle;
        }

        clean() {
            return (this.files = []), this.refreshPreviewFileList(), this.refreshValue(), this.$originEle;
        }

        uploadFiles() {
            return this.files;
        }

        initEvent() {
        }

        refreshValue() {
            let e = this.$originEle.val(),
                i = [];
            this.files.forEach((e) => {
                $('.jquery-uploader-preview-container').find('input[name="images[' + e.id + ']"]').val(e.name);
                (e.status !== h.fileStatus.uploaded && e.status !== h.fileStatus.initial) || i.push(e.name);
            });
            let t = i.join(",");
            e !== t && this.$originEle.val(t).trigger("change");
        }

        refreshPreviewFileList() {
            this.$uploaderContainer.empty(),
                this.files.forEach((e) => {
                    this.$uploaderContainer.append(e.$ele), e.$ele.find(".jquery-uploader-preview-action .file-delete")
                        .on("click", this.handleFileDelete.bind(this));
                }),
            (this.options.multiple || 0 === this.files.length) && (this.$uploaderContainer.append(this.$selectCard), this.$selectCard.on("click", this.handleFileSelect.bind(this)));
        }

        createDefaultFiles(e) {
            let i = [];
            this.options.defaultValue
                ? (i = this.options.defaultValue)
                : e &&
                (this.options.multiple ? e.split(",") : [e]).forEach((e, t) => {
                    let r = p(e);
                    i.push({name: "default" + t, type: r, url: e});
                }),
                i.forEach((e) => {
                    let i = u(),
                        t = this.createFileCardEle(i, e.url, e.type);
                    this.files.push({
                        id: i,
                        type: e.type,
                        name: e.name,
                        url: e.url,
                        status: h.fileStatus.initial,
                        file: null,
                        $ele: t
                    });
                }),
                this.refreshPreviewFileList(),
                this.refreshValue();
        }

        onFileUploadUpdate(e, i) {
            e.$ele.find(".jquery-uploader-preview-progress > .progress-mask").css("height", 100 - i + "%");
        }

        onFileUploadSuccess(e, i) {
            let t;
            this.$originEle.trigger("upload-success", e, i), e.$ele.find(s).hide(), e.$ele.find(".jquery-uploader-preview-action").show();
            try {
                if (((t = this.options.ajaxConfig.responseConverter(e, i)), !t.url)) return console.error("No URL"), void this.onFileUploadError(e, "No URL");
            } catch (i) {
                return console.error("Error", i), void this.onFileUploadError(e, "Error");
            }
            e.url && e.url.startsWith("blob") && d.revokeBlobUrl(e.url),
                (e.name = t.name || e.name),
                (e.url = t.url),
                (e.status = h.fileStatus.uploaded),
                e.$ele.find(".jquery-uploader-preview-main > img").attr("src", e.url),
                this.refreshPreviewFileList(),
                this.refreshValue();
        }

        onFileUploadError(e, i) {
            this.$originEle.trigger("upload-error", e, i), e.$ele.find(s).hide(), e.$ele.attr("title", i), this.fileCardError(e.$ele);
        }

        handleFileSelect() {
            t()(`<input type="file" ${this.options.multiple ? "multiple" : ""} />`)
                .on("change", (e) => {
                    this.handleFileAdd(e.target.files);
                })
                .click();
        }

        handleFileAdd(e) {
            let i = [];
            for (let t = 0; t < e.length; t++) {
                let r = e[t],
                    l = -1 !== r.type.indexOf("image") ? a : o,
                    s = d.createBlobUrl(r),
                    n = u(),
                    p = this.createFileCardEle(n, s, l);
                this.fileCardWaring(p), i.push({
                    id: n,
                    type: l,
                    name: r.name,
                    url: l,
                    status: h.fileStatus.selected,
                    file: r,
                    $ele: p
                });
            }
            this.files.push(...i), this.refreshPreviewFileList(), this.$originEle.trigger("file-add", i), !0 === this.options.autoUpload && this.handleFileUpload();
        }

        handleFileUpload() {
            let e = [];
            this.files.forEach((i) => {
                i.status === h.fileStatus.selected && e.push(i);
            }),
                this.$originEle.trigger("before-upload", e),
                e.forEach((e) => {
                    this.$originEle.trigger("uploading", e);
                    try {
                        this.fileCardDefault(e.$ele),
                            e.$ele.find(s).show(),
                            this.options.ajaxConfig.ajaxRequester(
                                this.options.ajaxConfig,
                                e,
                                (i) => {
                                    this.onFileUploadUpdate(e, i);
                                },
                                (i) => {
                                    this.onFileUploadSuccess(e, i);
                                },
                                (i) => {
                                    this.onFileUploadError(e, i);
                                }
                            );
                    } catch (i) {
                        this.onFileUploadError(e, "ajax the request is abnormal");
                    }
                });
        }

        handleFileDelete(e) {
            let i = t()(e.target).parents(".jquery-uploader-card"),
                r = i[0].id;
            i.remove();
            let l = -1;
            this.files.forEach((e, i) => {
                e.id === r && (l = i);
            });
            let s = this.files.splice(l, 1);
            s.url && d.revokeBlobUrl(s.url), this.$originEle.trigger("file-remove", ...s), this.refreshValue(), this.refreshPreviewFileList();
        }
    }

    (h.config = {
        paramsBuilder: function (e) {
            let i = new FormData();
            return i.append("file", e.file), i;
        },
        responseConverter: function (e, i) {
            return {url: i.data, name: i.name};
        },
        ajaxRequester: function (e, i, r, l, s) {
            t().ajax({
                url: e.url,
                contentType: !1,
                processData: !1,
                method: e.method,
                data: e.paramsBuilder(i),
                success: function (e) {
                    l(e);
                },
                error: function (e) {
                    console.error("Error", e), s("Error");
                },
                xhr: function () {
                    let e = new XMLHttpRequest();
                    return (
                        e.upload.addEventListener("progress", function (e) {
                            let i = (e.loaded / e.total) * 100;
                            r(i);
                        }),
                            e
                    );
                },
            });
        },
    }),
        (h.mode = {url: "url", file: "file", custom: "custom"}),
        (h.fileStatus = {
            selected: "selected",
            uploading: "uploading",
            uploaded: "uploaded",
            error: "error",
            initial: " initial"
        }),
        (h.defaults = {
            mode: h.mode.url,
            multiple: !1,
            defaultValue: null,
            parent: null,
            allowFileExt: "*",
            autoUpload: !0,
            ajaxConfig: {
                url: "",
                method: "post",
                paramsBuilder: h.config.paramsBuilder,
                ajaxRequester: h.config.ajaxRequester,
                responseConverter: h.config.responseConverter
            },
        }),
        ($.fn.uploader = function (e, ...i) {
            if ("string" == typeof e) {
                let t = $(this[0]).data(r);
                if (!t) throw "this is not a uploader instance";
                return t[e](...i);
            }
            return this.each(function () {
                let i = $(this),
                    t = i.data(r);
                t || ((t = new h(i, e || {})), i.data(r, t));
            });
        }),
        ($.fn.uploaderSetup = function (e) {
            window[l] = e;
        }),
        ($.Uploader = h);
})();
