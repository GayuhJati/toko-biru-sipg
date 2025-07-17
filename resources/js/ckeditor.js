import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export function initCKEditor(selector, uploadUrl) {
    ClassicEditor
        .create(document.querySelector(selector), {
            ckfinder: {
                uploadUrl: uploadUrl
            }
        })
        .catch(error => {
            console.error(error);
        });
}
