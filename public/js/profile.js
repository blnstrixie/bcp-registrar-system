var upload = document.getElementById("upload");
var preview = document.getElementById("preview");
var avatar = document.getElementById("avatar");
var avatar_name = document.getElementById("name");
var avatar_name_change_box = document.getElementById("change-name-box");

var avatars = {
  srcList: [
    {
      name: "Cosmos",
      src: encodeURIComponent("https://source.unsplash.com/rTZW4f02zY8/150x150"),
    },
  ],
  activeKey: 1,
  add: function (_name, _src) {
    this.activeKey = this.srcList.length;
    return this.srcList.push({ name: _name, src: encodeURIComponent(_src) }) - 1;
  },
  changeName: function (key, _name) {
    if (!Number.isInteger(key)) {
      return false;
    }
    this.srcList[key].name = _name;
    if (avatar_name.dataset.key == key) {
      avatar_name.textContent = _name;
    }
    return _name;
  },
  showNext: function () {
    var _next = this.activeKey + 1;
    if (_next >= this.srcList.length) {
      _next = 0;
    }
    this.showByKey(_next);
  },
  showLast: function () {
    var _next = this.activeKey - 1;
    if (_next < 0) {
      _next = this.srcList.length - 1;
    }
    this.showByKey(_next);
  },
  showByKey: function (_next) {
    var _on = this.srcList[_next];
    if (!_on.name) return;

    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    var img = document.createElement("img");
    img.src = decodeURIComponent(_on.src);
    img.className = "avatar_img--loading";
    img.onload = function () {
      img.classList.add("avatar_img");
    };
    avatar_name.textContent = _on.name;
    avatar_name.setAttribute("data-key", _next);
    preview.appendChild(img);
    this.activeKey = _next;
  },
};

upload.addEventListener("change", handleFiles, false);
function handleFiles() {
  var files = this.files;
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var imageType = /^image\//;

    if (!imageType.test(file.type)) {
      avatar.classList.add("avatar--upload-error");
      setTimeout(function () {
        avatar.classList.remove("avatar--upload-error");
      }, 1200);
      continue;
    }

    avatar.classList.remove("avatar--upload-error");

    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    var img = document.createElement("img");
    img.file = file;
    img.src = window.URL.createObjectURL(file);
    img.onload = function () {
    };
    img.className = "avatar_img";

    document.activeElement.blur();
    window.getSelection().removeAllRanges();

    var _avatarKey = avatars.add(file.name, img.src);
    avatar_name.textContent = ''; // Clear the file name
    avatar_name.setAttribute("data-key", _avatarKey);
    preview.appendChild(img);
  }
}

window.changeAvatarName = function (event, key, name) {
  if (event.keyCode != 13 && event != "blur") return;
  key = parseInt(key);
  if (!name) return;
  var change = avatars.changeName(key, name);
  document.activeElement.blur();

  window.getSelection().removeAllRanges();
};

window.changeAvatar = function (dir) {
  if (dir === "next") {
    avatars.showNext();
  } else {
    avatars.showLast();
  }
};

window.handleAriaUpload = function (e, obj) {
  if (e.keyCode == 13) {
    obj.click();
  }
};
