<template>
  <ValidationObserver ref="observer">
    <form @submit.prevent="submit">
      <div class="form-row text-muted">
        <div
          v-for="(f, index) in form"
          :key="index"
          class="form-group"
          :class="f.cssClass || 'col-md-6'"
        >
          <label :for="'from_' + index">{{ f.title }}
            <span v-if="f.validate" class="text-danger">*</span>
          </label>
          <ValidationProvider :rules="f.validate" v-slot="v">
            <textarea
              class="form-control"
              v-if="f.type == 'textarea'"
              v-model="innerValue[index]"
              :name="index"
              v-validate="f.validate"
              :id="'from_' + index"
              :class="v.errors[0] ? 'is-invalid' : ''"
              cols="30"
              rows="3"
              :placeholder="f.placeholder"
            ></textarea>
            <div v-else-if="f.type == 'radio'">
              <div v-for="(radio, key) in f.dataSource" :key="key" class="form-check">
                <input

                  v-model="innerValue[index]"
                  class="form-check-input"
                  type="radio"
                  :name="index"
                  :id="index + radio.id"
                  :value="radio.id"
                />
                <label class="form-check-label" :for="index + radio.id">{{
                  radio.name
                }}</label>
              </div>
            </div>
            <input
              v-else
              v-model="innerValue[index]"
              :name="index"
              type="text"
              class="form-control"
              :id="'from_' + index"
              :class="v.errors[0] ? 'is-invalid' : ''"
              v-validate="f.validate"
              :placeholder="f.placeholder"
            />
          </ValidationProvider>
          <small class="text-danger form-text">{{ errors.first(index) }}</small>
        </div>
      </div>
    </form>
  </ValidationObserver>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  props: {
    form: {
      require: true,
      type: Object,
    },
    value: {
      name: 1
    },
  },
  data() {
    return {
      innerValue: this.value,
    };
  },
  watch: {
    innerValue(value) {
      this.$emit("input", value);
    },
  },
  mounted() {
    this.innerValue = this.value;
    this.$validator.localize("en", {
      custom: this.form,
    });
  },
  methods: {
    submit() {
      this.$emit("input", this.value);
    },
  },
};
</script>

<style lang="css" scoped>
.form-control,
.btn {
  border-radius: 0;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #ccc;
  outline: 0;
  box-shadow: 0 0 0 0.2rem #e9ecef;
}

label {
  margin-bottom: 0.25rem;
}
</style>
