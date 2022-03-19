// Common ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function cs(element, func) {
  if (func && typeof func === 'function') {
    func(cs(element));
  } else {
    if (typeof element === 'string') {
      if (document.querySelectorAll(element).length > 1) {
        return (document.querySelectorAll(element));
      } else {
        return (document.querySelector(element));
      }
    }
    else if (typeof element === 'object') {
      return element;
    }
  }
}

function csRemove(element) {
  cs(element, (obj) => {
    if (obj && obj.length) {
      obj.forEach((one) => {
        csRemoveOne(one);
      });
    } else {
      csRemoveOne(obj);
    }
  });
}

function csRemoveOne(one) {
  if (one) {
    if (one.parentNode) {
      one.parentNode.removeChild(one);
    }
  }
}

function csShowDialog(element, html) {
  cs(element, (obj) => {
    var child = document.createElement('div');
    child.classList.add('cs-dialog');
    child.addEventListener('click', () => {
      csRemove(child);
    });
    var note = document.createElement;
    child.innerHTML = html;
    obj.appendChild(child);
  });
}

function csHtml(element) {
  let html;
  cs(element, (obj) => {
    html = obj.innerHTML;
  });
  return html;
}

function csHasClass(element, cls) {
  return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
// End Common ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~



// Toggle ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function csInitToggle(element) {
  var ele = cs(element);
  if (ele && ele.length) {
    ele.forEach(function (one) {
      csToggleOne(one);
    });
  } else {
    ele && csToggleOne(ele);
  }
}

function csToggleOne(one) {
  var button = document.createElement('a');
  var box = document.createElement('span');
  var check = document.createElement('input');
  var toggle = document.createElement('span');

  var name = one.getAttribute('cs-name');
  var request = one.getAttribute('cs-request');
  var type = one.getAttribute('cs-type');

  check.setAttribute('name', name);
  // button.setAttribute('href','#');

  button.appendChild(check);
  button.appendChild(box);
  button.appendChild(toggle);
  one.appendChild(button);

  console.log(type);
  switch (type) {
    case 'checkbox':
      check.setAttribute('type', 'checkbox');
      button.classList.add('cs-button-checkbox');
      break;
    case 'radio':
      check.setAttribute('type', 'radio');
      toggle.className = 'cs-toggle-radio';
      box.className = 'cs-box-radio';
      button.classList.add('cs-button-radio');
      break;

    default:
      check.setAttribute('type', 'checkbox');
      button.classList.add('cs-button-toggle');
      break;
  }

  if (csHasClass(one, 'checked')) {
    button.classList.add('checked');
    check.checked = true;
  }

  one.className = 'cs-container-toggle';
  console.log(request);
  // has reques
  if (request) {
    button.addEventListener('click', (ele) => {
      // send
      $.ajax({
        url: request,
        type: 'GET',
        dataType: 'html',
        data: { data: check.checked },
      })
        // end send
        .done(function (e) {
          if (e == 1) {
            button.classList.add('checked');
            check.checked = true;
          } else {
            button.classList.remove('checked');
            check.checked = false;
          }
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("complete");
        });
    });
  } else {
    button.addEventListener('click', (ele) => {
      if (csHasClass(button, 'checked')) {
        button.classList.remove('checked');
        check.checked = false;
      } else {
        button.classList.add('checked');
        check.checked = true;
      }
    });
  }
}
// End Toggle ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// Dialog ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function csInitDialog(option) {
  var csDialog = document.createElement('div');
  var csDialogContainer = document.createElement('div');
  var csDialogContent = document.createElement('div');
  var csDialogClose = initElement({
    element: 'button',
    class: 'cs-dialog-close',
    text: '<i class="icon-close"></i>',
    event: 'close'
  }, () => {
    csRemove(csDialog);
  });


  var csDialogHeader = initElement(option.header, (event, eventName) => {
    console.log('clickHeader');
  });
  var csDialogBody = initElement(option.body, (event, eventName) => {
    console.log('clickBody');
  });
  var csDialogFooter = initElement(option.footer, (event, eventName) => {
    if (eventName === 'close') {
      csRemove(csDialog);
    }
  });

  csDialog.classList.add('cs-dialog');
  csDialogContainer.classList.add('cs-dialog-container');
  csDialogContent.classList.add('cs-dialog-content');

  csDialogContainer.appendChild(csDialogContent);
  csDialogContent.appendChild(csDialogHeader);
  csDialogContent.appendChild(csDialogClose);
  csDialogContent.appendChild(csDialogBody);
  csDialogContent.appendChild(csDialogFooter);
  csDialog.appendChild(csDialogContainer);
  cs('body').appendChild(csDialog);


  document.addEventListener('keydown', (event) => {
    if (event.keyCode === 27) {
      if (cs('.cs-dialog')) {
        closeDialog();
      }
    }
  });

  function closeDialog() {
    csRemove(csDialog);
  }
}

// End dialog ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function csReload(url) {
  window.location.replace(url);
}

function initElement(element = null, func) {
  if (element) {
    if (element.element) {
      var ele = document.createElement(element.element);
      if (element.text) {
        ele.innerHTML = element.text;
      }
      if (element.class) {
        ele.className = element.class;
      }
      if (element.event) {
        ele.addEventListener('click', (e) => {
          func(e, element.event);
        });
      }
      if (element.attr) {
        for (var attribute in element.attr) {
          ele.setAttribute(attribute, element.attr[attribute]);
        }
      }

      if (element.content) {
        for (var eleChild in element.content) {
          ele.appendChild(initElement(element.content[eleChild], func));
        }
      }
      return ele;
    }
  }
}

csInitPaginations('[init-controll="pagination"]');

function csInitPaginations(element) {
  var ele = cs(element);
  if (ele == null) return;
  if (ele.length) {
    ele.forEach(function (one) {
      csInitPagination(one);
    });
  } else {
    csInitPagination(ele);
  }
}

// Paginaiton
function csInitPagination(one) {
  var element = cs(one);
  element.className = 'cs-pagination';
  var num = Number(element.getAttribute('cs-num'));
  var record = Number(element.getAttribute('cs-record'));
  var cur = Number(element.getAttribute('cs-cur'));
  var total = Number(element.getAttribute('cs-total'));
  var request = element.getAttribute('cs-request');
  var query = element.getAttribute('cs-query');
  total = Math.ceil(total / record);
  if (total === 1) {
    return;
  }

  if (num > total) {
    num = total;
  }

  var first = document.createElement('a');
  var next = document.createElement('a');
  var prev = document.createElement('a');
  var last = document.createElement('a');

  // first.setAttribute('href', '#first');
  // next.setAttribute('href', '#next');
  // prev.setAttribute('href', '#prev');
  // last.setAttribute('href', '#last');

  var focus = cur;

  var listChild = document.createElement('div');
  listChild.classList.add('list-child');

  updatePagination(listChild, cur, num, total, request, focus, record, query);

  first.classList.add('one-page');
  first.classList.add('first');
  next.classList.add('one-page');
  prev.classList.add('one-page');
  prev.classList.add('prev');
  last.classList.add('one-page');
  last.classList.add('last');

  first.innerHTML = '<i class="fa fa-angle-double-left"></i>';
  prev.innerHTML = '<i class="fa fa-angle-left"></i>';
  next.innerHTML = '<i class="fa fa-angle-right"></i>';
  last.innerHTML = '<i class="fa fa-angle-double-right"></i>';

  element.appendChild(first);
  element.appendChild(prev);
  element.appendChild(listChild);
  element.appendChild(next);
  element.appendChild(last);

  next.addEventListener('click', function () {
    focus++;
    focus = updatePagination(listChild, cur, num, total, request, focus, record, query);
    csReload( request + `?page=${focus}&${query}`);
  });

  prev.addEventListener('click', function () {
    focus--;
    focus = updatePagination(listChild, cur, num, total, request, focus, record, query);
    csReload( request + `?page=${focus}&${query}`);
  });

  first.addEventListener('click', function () {
    focus = 1;
    focus = updatePagination(listChild, cur, num, total, request, focus, record, query);
    csReload( request + `?page=${focus}&${query}`);
  });

  last.addEventListener('click', function () {
    focus = total;
    focus = updatePagination(listChild, cur, num, total, request, focus, record, query);
    csReload( request + `?page=${focus}&${query}`);
  });
}

function updatePagination(listChild, cur, num, total, request, focus, record, query) {
  if (focus > total) {
    return total;
  }
  if (focus < 1) {
    return 1;
  }
  listChild.innerHTML = '';

  var start = 1;
  var end = 1;

  if (focus > Math.floor(num / 2) && focus < total - Math.floor(num / 2)) {
    start = focus - Math.floor(num / 2);
  } else if (focus >= total - Math.floor(num / 2)) {
    start = (total - num) + 1;
  }

  end = start + num - 1;

  // Render child
  for (var i = start; i <= end; i++) {
    var onePage = document.createElement('a');
    onePage.classList.add('one-page');
    onePage.innerHTML = i;
    listChild.appendChild(onePage);
    if (i == cur) {
      onePage.classList.add('selected');
    }
    if (i != cur && focus == i) {
      onePage.classList.add('focus');
    }
    // onePage.setAttribute('href', request + `current=${i}&record=${record}`);
    onePage.setAttribute('href', request + `?page=${i}&${query}`);
  }
  return focus;
}
// End Pagination



// Drag size ---------------------------------------

function csInitDragSize(element) {
  cs(element, (obj) => {
    if (obj.length) {
      obj.forEach((one) => {
        csInitOneDragSizeOne(one)
      });
    } else {
      csInitOneDragSizeOne(obj)
    }
  });
}

function csInitOneDragSizeOne(one) {
  var element = cs(one);
  var thumb = document.createElement('div');
  thumb.classList.add('cs-thumb-drag');
  element.appendChild(thumb);
  var run = false;
  var event;
  var stateElemnt =
  {
    clientWidth: element.clientWidth,
    clientHeight: element.clientHeight
  };
  thumb.addEventListener('mousedown', function (e) {
    if (!run) {
      run = true;
      event = e;
      stateElemnt.clientWidth = element.clientWidth;
      cs('body').style = 'cursor: e-resize';
      stateElemnt.clientHeight = element.clientHeight;
      e.preventDefault();
      e.stopPropagation();
    }
  });
  document.addEventListener('mouseup', function (e) {
    run = false;
    cs('body').style = 'cursor: auto';
    event = null;
    e.preventDefault();
    e.stopPropagation();
  });

  document.addEventListener('mousemove', function (e) {
    if (run) {
      var x = e.screenX - event.screenX;
      var y = e.screenY - event.screenY;
      console.log(x);
      console.log(e);
      w = stateElemnt.clientWidth + x;
      element.style = `width: ${w}px `;
    }
    e.preventDefault();
    e.stopPropagation();
  });

}

// End drag size -----------------------------------

// Upload file --------------------------------------------------------
csInitFormFiles('[init-controll="upload"]');

function csInitFormFiles(element) {
  var ele = cs(element);
  if (ele == null) return;
  if (ele.length) {
    ele.forEach(function (one) {
      csInitFormFile(one);
    });
  } else {
    csInitFormFile(ele);
  }
}

function csInitFormFile(element) {
  var pane = cs(element);
  pane.className = 'cs-form-upload';
  createBoxFile(pane);
}

function createBoxFile(pane) {

  var box = document.createElement('div');
  var thumb = document.createElement('div');
  var input = document.createElement('input');
  var label = document.createElement('div');
  var actionTop = document.createElement('div');
  var actionBot = document.createElement('div');
  var memory = document.createElement('div');
  var first = true;
  var multiple = pane.getAttribute('cs-multiple');
  if (!multiple) {
    pane.className = 'cs-form-upload one';
  } else {
    pane.className = 'cs-form-upload';
  }

  box.classList.add('cs-box-file');
  box.classList.add('click');
  thumb.classList.add('cs-thumb');
  input.classList.add('cs-input-file');
  label.classList.add('cs-label-file');
  memory.classList.add('cs-memory-file');
  input.setAttribute('type', 'file');
  input.setAttribute('accept', pane.getAttribute('cs-accept'));
  thumb.innerHTML = '<i class="fa fa-upload"></i>';

  box.appendChild(actionTop);
  box.appendChild(thumb);
  thumb.appendChild(input);
  box.appendChild(actionBot);

  input.addEventListener('change', () => {
    if (input.files && input.files[0]) {
      csLoading('show');
      var reader = new FileReader();
      reader.onload = function (e) {
        thumb.style.background = `url(${e.target.result}) center`;
        thumb.style.backgroundSize = `cover`;

        if (first) {
          first = false;
          input.setAttribute('name', pane.getAttribute('cs-name'));
          actionTop.classList.add('action-top-file');
          actionBot.classList.add('action-bot-file');

          thumb.innerHTML = '';
          thumb.appendChild(input);
          createBoxFile(pane);
          box.classList.remove('click');
          var buttonRemove = document.createElement('div');
          buttonRemove.classList.add('cs-remove-file');
          buttonRemove.innerHTML = '✖';
          actionTop.appendChild(buttonRemove);

          buttonRemove.addEventListener('click', () => {
            csRemove(box);
          });
        }
        label.innerHTML = input.files[0].name;
        memory.innerHTML = input.files[0].size + ' Bytes';
        if (input.files[0].size > 2696000) {
          csLoading();
          Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'File size went wrong!'
          })
          csRemove(box);
        }
        actionBot.appendChild(label);
        actionBot.appendChild(memory);
        csLoading();
      }
      reader.onerror = function() {
        alert()
      }

      reader.readAsDataURL(input.files[0]);
    }
  });
  pane.appendChild(box);
}

function initShowImage(ele) {
  // ele.addEventListener('click',  () => {
  var control = document.createElement('div');
  var wapper = document.createElement('div');
  var img = document.createElement('img');
  var src = ele.getAttribute('src');
  control.classList.add('cs-image-center');
  control.classList.add('cs-show-image');
  wapper.classList.add('cs-image-center');
  wapper.classList.add('wapper-img');

  control.appendChild(initButtonImage(() => { closeAction(); }));
  wapper.appendChild(img);
  control.appendChild(wapper);
  control.appendChild(initImages(ele, control, (src) => {
    transform.X = 0;
    transform.Y = 0;
    scale = 1;
    img.setAttribute('src', src);
    updateImage();
  }));

  cs('body').appendChild(control);
  cs('body').style.overflow = 'hidden';
  document.addEventListener('keydown', (e) => {
    if (e.keyCode === 27) {
      closeAction();
    }
  });

  var eventOld = null;
  var scale = 1;
  var onDrag = false;
  var transform = {
    X: 0,
    Y: 0
  };
  img.src = src;
  updateImage();

  img.addEventListener('mousedown', (e) => {
    eventOld = e
    img.classList.add('mouse-move');
    onDrag = true;
    e.preventDefault();
  });

  document.addEventListener('mouseup', (e) => {
    onDrag = false;
    img.classList.remove('mouse-move');
  });

  control.addEventListener('mousemove', (e) => {
    if (onDrag) {
      transform.X += e.clientX - eventOld.clientX;
      transform.Y += e.clientY - eventOld.clientY;
      updateImage();
      eventOld = e;
    }
  });

  control.addEventListener('wheel', (e) => {
    if (e.deltaY > 0) {
      scale *= (scale > 1) ? 0.6 : 1;
    } else {
      scale /= 0.6;
    }
    updateImage();
    eventOld = e;
    e.preventDefault();
  });

  document.addEventListener('keyup', (e) => {
    if (e.keyCode === 40) {
      scale *= (scale > 1) ? 0.6 : 1;
    } else if (e.keyCode === 38) {
      scale /= 0.6;
    }
    updateImage();
    eventOld = e;
    e.preventDefault();
  });

  function updateImage() {
    wapper.style.transform = `scale(${scale})`;
    img.style = `
        transform : translate( ${ transform.X / scale}px, ${transform.Y / scale}px);
        max-width: ${window.innerWidth - 20}px;
        max-height: ${window.innerHeight - 140}px
      `;
  }

  function closeAction() {
    csRemove(control);
    cs('body').style.overflow = 'auto';
  }
}

function initImages(ele, control, func) {
  var className = ele.className;
  var listView = document.createElement('div');
  var listViewContent = initPaneDrag();
  listView.classList.add('cs-view-images');
  listViewContent.classList.add('cs-view-images-content');
  var imgs = cs('*' + '.' + className);
  if (imgs && imgs.length) {
    imgs.forEach((one) => {
      var image = document.createElement('img');
      var boxImage = document.createElement('button');
      boxImage.addEventListener('focus', () => {
        func(one.getAttribute('src'));
      });
      boxImage.addEventListener('keydown', (e) => {

        if (e.keyCode === 39 && boxImage.nextElementSibling) {
          boxImage.nextElementSibling.focus();
        }
        if (e.keyCode === 37 && boxImage.previousElementSibling) {
          boxImage.previousElementSibling.focus();
        }
      });
      image.setAttribute('src', one.getAttribute('src'));
      boxImage.appendChild(image);
      boxImage.classList.add('cs-box-image');
      boxImage.classList.add('cs-image-center');
      listViewContent.appendChild(boxImage);
    });
  } else {
    return document.createElement('div');;
  }
  listView.appendChild(listViewContent);
  return listView;
}

function initButtonImage(func) {
  var button = document.createElement('button');
  button.classList.add('cs-image-close');
  button.innerHTML = '✖';
  button.addEventListener('click', () => { func(); });
  return button;
}

function initPaneDrag() {
  var pane = document.createElement('div');
  var eventOld = null;
  var isDrag = false;
  var scroll = {
    X: 0,
    Y: 0
  };

  pane.addEventListener('mousedown', (e) => {
    eventOld = e;
    isDrag = true;
    pane.classList.add('mouse-move');
  });

  document.addEventListener('mouseup', (e) => {
    isDrag = false;
    pane.classList.remove('mouse-move');
  });

  pane.addEventListener('mousemove', (e) => {
    if (isDrag) {
      scroll.X = scroll.X + e.clientX - eventOld.clientX;
      pane.scrollLeft = - scroll.X;
      eventOld = e;
    }
  });
  return pane;
}

// document.addEventListener('click', (e)=>{
//  var item = {
//     Tải_hình: {
//       name: 'Tải hình'
//     },
//     Đăng_hình: {
//       name: 'Đăng hình'
//     },
//     Cài_đặt: {
//       name: 'Cài đặt',
//       item :{
//           Ẩn: {
//             name: 'Ẩn'
//           },
//           Thay_đổi: {
//             name: 'Thay đổi'
//           },
//           Xóa: {
//              name: 'Xóa'
//           },
//           Chuyển_đến: {
//             name: 'Chuyển đến',
//              item :{
//                 Menu: {
//                 name: 'Menu'
//               }
//             }
//           },
//       }
//     },
//  }
// csRemove('.cs-context-menu');
// initContextMenu(e.clientX, e.clientY, item, (e)=>{
//    alert(e);
//   });
// });

// Context menu
function initContextMenu(x, y, item, func) {
  var windowRight = window.innerWidth;
  var windowBottom = window.innerHeight;
  var context = document.createElement('ul');
  context.classList.add('cs-context-menu');
  context.style.left = x + 'px';
  context.style.top = y + 'px';
  cs('body').appendChild(context);

  for (let name in item) {
    let li = document.createElement('li');
    li.innerHTML = item[name].name;
    var click = true;
    var child;
    li.addEventListener('mouseover', (e) => {
      if (item[name].item) {
        var posY = li.getBoundingClientRect().top;
        var posX = li.getBoundingClientRect().right;
        child = initContextMenu(posX, posY, item[name].item, func);

      }
      e.preventDefault();
      e.stopPropagation();
    });

    li.addEventListener('mouseout', (e) => {
      csRemove(child);
      e.preventDefault();
      e.stopPropagation();
    });


    li.addEventListener('click', (e) => {
      func(name);
      e.preventDefault();
      e.stopPropagation();
    });
    context.appendChild(li);
  }
  context.addEventListener('click', (e) => {

    e.preventDefault();
    e.stopPropagation();
  });
  return context;
}

// Loadding
function csLoading(action='') {
  let loading = cs('.view-load');
  loading.className='view-load ' + action;
}

// Form
csForm();
function csForm() {
  if (cs('form')) {
    cs('form').addEventListener('submit', () => {
      csLoading('show');
    });
  }
}