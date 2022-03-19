<template>
  <div>
    <div class="btn-group d-flex">
      <button
        class="btn btn-light mb-0 font-weight-bold rounded-0"
        style="border-color: #eee"
        @click="onDown"
        :disabled="inner == 1"
      >
        <i class="pe-7s-less text-dark"></i>
      </button>

      <input
        class="form-control rounded-0 text-center"
        type="number"
        v-model="inner"
        style="flex: 1; width: 60px; border-color: #eee; border-left: 0; border-right: 0"
      />

      <button
        class="btn btn-light mb-0 font-weight-bold rounded-0"
        style="border-color: #eee"
        @click="onUp"
        :disabled="inner == 100"
      >
        <i class="pe-7s-plus text-dark"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["value"],
  data() {
    return {
      inner: 0,
    };
  },
  watch: {
    inner(newVal) {
      if (newVal < 1) {
        this.inner = 1;
      }
      if (newVal > 100) {
        this.inner = 100;
      }
      this.$emit("input", newVal);
    },
  },
  mounted() {
    this.inner = this.value;
  },
  methods: {
    onDown() {
      this.inner == 1 ? this.inner == 1 : this.inner--;
    },
    onUp() {
      this.inner++;
    },
  },
};
</script>

<style lang="scss" scoped>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}

button {
  display: flex;
  justify-content: center;
  align-items: center;
  i {
    font-size: 20px;
  }
}
</style>
