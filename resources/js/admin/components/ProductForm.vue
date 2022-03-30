<template>
  <div>
    <div class="card card-accent-success">
      <div class="card-header"><i class="fa fa-file-image-o"></i>Hình ảnh</div>
      <div class="card-body">
        <div class="product-image">
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
            v-if="
              innerImages.reduce(function (acc, curr) {
                if (curr.show) acc++;
                return acc;
              }, 0) < 9
            "
            class="product-image-upload"
          >
            <label class="product-upload-thumb">
              <i class="fa fa-plus"></i>
              <input type="file" hidden @change="onChange" multiple />
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-accent-success">
      <div class="card-header"><i class="fa fa-file-image-o"></i>Thuộc tính</div>
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

export default {
  props: ["images", "postImageStore", "properties", "getPropertyPage"],
  data() {
    return {
      file: null,
      innerImages: [],
      BASE_URL
    };
  },
  created() {
    this.innerImages = this.images.map((item) => ({ show: true, ...item }));
  },
  methods: {
    async onChange(event) {
      const form = new FormData();
      console.log(event);
      const files = event.target.files;
      for (let index = 0; index < files.length; index++) {
        form.append(`files[${index}]`, files[index]);
      }

      const { data } = await Axios.post(this.postImageStore, form);
      this.innerImages = [...this.innerImages, ...data.map((item) => ({ show: true, ...item }))];
    },

    onRemoveImage(image) {
      Swal.fire({
        title: "Bạn có muốn xóa ảnh này ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa",
      }).then((result) => {
        if (result.value) {
          image.show = false;
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
  .product-image-item {
    width: calc(100% / 3 - 8px);
    position: relative;
    border: 2px solid #dedede;
    margin: 4px;
    border: 1px dashed #ddd;
    padding: 5px;

    .product-image-thumb {
      padding-top: 130%;
      background-size: cover;
      background-position: center;
    }
    &:hover {
      .product-image-remove {
        opacity: 1;
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
