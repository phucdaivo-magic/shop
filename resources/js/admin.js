
// Bootstrap date pocker and select2
window.$ = window.jQuery = require('jquery');
import '../../node_modules/bootstrap-datepicker';
import '../../node_modules/select2';
import Swal from '../../node_modules/sweetalert2/src/sweetalert2.js';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import MyUploadAdapter from "./plugins/MyUploadAdapter"
import ProductForm from "./admin/components/ProductForm.vue"
import Vue from 'vue';

Vue.component('product-form', ProductForm);

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
    ClassicEditor
      .create(element, {
        extraPlugins: [(editor) => {
          editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
          };
        }],
      })
      .then(editor => {
        // Simulate label behavior if textarea had a label
        if (editor.sourceElement.labels.length > 0) {
          editor.sourceElement.labels[0].addEventListener('click', e => editor.editing.view.focus());
        }
      })
      .catch(error => {
        console.error(error);
      });
  });
  // CKEDITOR.replace('description');


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


let labels = [
  'January',
  'February',
  'March',
  'April',
  'May',
  'June',
];

// const data = {
//     labels: labels,
//     datasets: [{
//         label: 'My First dataset',
//         backgroundColor: 'rgb(255, 99, 132)',
//         borderColor: 'rgb(255, 99, 132)',
//         data: [0, 10, 5, 2, 20, 30, 45],
//     }]
// };


const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

// const config = {
//     type: 'line',
//     data: data,
//     options: {}
// };


const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};


document.addEventListener('DOMContentLoaded', () => {
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
});

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('form-product')) {
    new Vue({
      el: '#form-product',
    }).$mount();
  }
});
