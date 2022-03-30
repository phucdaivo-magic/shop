<template>
  <div>
    <div class="card card-accent-success">
      <div class="card-header d-flex align-items-center">
        <i class="fa fa-file-image-o"></i>
        <span style="flex: 1"> Hình ảnh </span>
        <div
          v-if="loading"
          class="spinner-border text-success"
          style="width: 1rem; height: 1rem; border-width: 2px"
          role="status"
        ></div>
      </div>
      <div class="card-body">
        <div>
          <draggable
            class="product-image"
            v-model="innerImages"
            @change="onEnd"
            ghost-class="ghost-class"
            draggable=".product-image-item"
          >
            <div
              v-for="image in innerImages"
              :key="image.id"
              class="product-image-item"
              v-show="image.show"
            >
              <!-- <img class="product-image-thumb" :src="image.avatar" alt="" /> -->
              <div
                class="product-image-thumb"
                :style="{ backgroundImage: `url('${image.avatar}')` }"
              >
                <button class="product-image-remove btn" @click="onRemoveImage(image)">
                  <i class="icons d-block cui-trash"></i>
                </button>
              </div>
              <div class="text-center pt-2">
                <toogle
                  :checked="image.active"
                  :request="BASE_URL + '/admin/product-image/put/active/' + image.id"
                />
              </div>
            </div>
            <div
              v-if="innerImages.filter((image) => image.show).length < 9"
              class="product-image-upload"
            >
              <label class="product-upload-thumb">
                <i class="fa fa-plus"></i>
                <input type="file" hidden @change="onChange" multiple />
              </label>
            </div>
          </draggable>
        </div>
      </div>
      <div v-if="update" class="card-footer">
        <button class="btn btn-success">Cập nhật thứ tự hiển thị</button>
      </div>
    </div>
    <div class="card card-accent-success">
      <div class="card-header"><i class="nav-icon cui-layers"></i>Thuộc tính</div>
      <div class="card-body">
        <div class="property">
          <div
            class="property-item bg-light rounded p-2 mb-1"
            v-for="property in properties"
            :key="property.id"
          >
            - {{ property.name }}
            <div
              v-for="detail in property.product_property_details"
              :key="detail.id"
              class="pl-3"
            >
              + {{ detail.name }}
            </div>
          </div>
        </div>
        <a class="btn btn-success mt-2" :href="getPropertyPage">Tuỷ chỉnh thuộc tính</a>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import draggable from "vuedraggable";

export default {
  props: [
    "product",
    "images",
    "postImageStore",
    "properties",
    "getPropertyPage",
    "postImageSort",
  ],
  components: {
    draggable,
  },
  data() {
    return {
      file: null,
      innerImages: [],
      BASE_URL,
      update: false,
      loading: false,
    };
  },
  created() {
    this.innerImages = this.convertData(this.images);
  },

  methods: {
    convertData(images) {
      return images.map((item) => ({ show: true, ...item }));
    },

    async onEnd() {
      this.loading = true;
      const ids = this.innerImages.filter((image) => image.show).map((item) => item.id);

      await Axios.post(this.postImageSort, {
        ids,
      });

      setTimeout(() => {
        this.loading = false;
      }, 300);
    },

    async onChange(event) {
      const form = new FormData();
      this.loading = true;
      const files = event.target.files;
      for (let index = 0; index < files.length; index++) {
        form.append(`files[${index}]`, files[index]);
      }

      const { data } = await Axios.post(this.postImageStore, form);

      this.innerImages = [...this.innerImages, ...this.convertData(data)];

      setTimeout(() => {
        this.loading = false;
      }, 300);
    },

    onRemoveImage(image) {
      Swal.fire({
        title: "Bạn có muốn xóa ảnh này ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa",
      }).then(async (result) => {
        if (result.value) {
          image.show = false;
          this.loading = true;
          const { data } = await Axios.delete(
            `${this.BASE_URL}/admin/api/product-image/${image.id}`
          );
          setTimeout(() => {
            this.loading = false;
          }, 300);
        }
      });
    },
  },
};
</script>

<style lang="scss" scroped>
.product-image {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  margin: -10px;

  .product-image-item {
    width: calc(100% / 3 - 8px);
    position: relative;
    border: 2px solid #dedede;
    margin: 4px;
    border: 1px dashed #ddd;
    padding: 5px;
    background: #fff;

    &.ghost-class {
      border: 1px solid #dedede;
      background: #eee;
      & > * {
        display: none;
      }
    }

    &:first-child {
      //width: calc(100% / 3 * 2 - 8px);
    }

    .product-image-thumb {
      padding-top: 120%;
      background-size: cover;
      background-position: top;
    }
    &:hover {
      .product-image-remove {
        opacity: 1;
      }
      &:before {
        content: "";
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        background: rgba(0, 0, 0, 0.04);
        top: 0;
        left: 0;
        cursor: pointer;
      }
    }
    .product-image-remove {
      position: absolute;
      top: 0;
      right: 0;
      padding: 4px 8px;
      background: #e11d48;
      padding: 0;
      border: none;
      width: 25px;
      height: 25px;
      border-radius: 4px;
      margin: 5px;
      outline: 0;
      opacity: 0;
      transition: 0.5s;
      i {
        color: #fff;
      }
    }
  }
  .product-image-upload {
    width: calc(100% / 3);
    position: relative;

    .product-upload-thumb {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      background-size: cover;
      border: 1px dashed #ddd;
      margin: 10px;
      border-radius: 3px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      background: #fafafa;
      i {
        color: #333;
        font-size: 20px;
      }
    }
    &::after {
      content: "";
      display: block;
      padding-top: 130%;
      width: 100%;
    }
  }
}

.property {
  .property-item {
    margin: 0 0 5px 0;
  }
}
</style>
