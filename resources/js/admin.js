
// Bootstrap date pocker and select2
window.$ = window.jQuery = require('jquery');
import '../../node_modules/bootstrap-datepicker';
import '../../node_modules/select2';
import Swal from '../../node_modules/sweetalert2/src/sweetalert2.js';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
window.Swal = Swal;

$(document).ready(function () {

    $('[data-init-plugin=select2]').select2();
    $('[data-init-plugin=datepicker]').datepicker({
        templates: {
            leftArrow: '<i class="icon-arrow-left icons"></i>',
            rightArrow: '<i class="icon-arrow-right icons"></i>'
        },
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    Array.prototype.forEach.call($('[data-init-plugin=ckeditor]'), element => {
        ClassicEditor.create(element)
    });

    Array.prototype.forEach.call($('[action-delete=button]:not([href=""])'), element => {
        let href = $(element).attr('href');
        $(element).attr('href', 'javascript:;');
        $(element).click(function () {
            initButtonSwal(href);
        });
    });

    function initButtonSwal(href) {
        Swal.fire({
            title: 'Bạn có muốn xóa ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa'
        }).then((result) => {
            if (result.value) {
                csReload(href);
                csLoading('show');
            }
        });
    }

    csLoading();

});


