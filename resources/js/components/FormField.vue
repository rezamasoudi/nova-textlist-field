<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <div class="masoudi-nova-textlist w-full form-control form-input form-input-bordered" :class="errorClasses">
        <div v-for="(text, index) in textlist" :key="index"
          class="bg-primary-500 text-white dark:text-gray-800 text-item">
          {{ text }}
          <svg @click="removeItemByIndex(index)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <input :id="field.attribute" type="text" :placeholder="placeholder" v-model="value" @keyup.enter="onEnter"
          @keyup.backspace="onBackspace" @keypress.enter.prevent />
      </div>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  data: () => ({ textlist: [] }),

  computed: {
    /**
     * Get placeholder message
     */
    placeholder() {
      return this.field.extraAttributes?.placeholder ?? this.field.name;
    },
  },

  methods: {
    /**
     * Push new text on enter key press
     */
    onEnter() {
      if (this.value) {
        this.textlist.push(this.value);
        this.value = "";
      }
    },

    /**
     * Remove list item by index
     * @param {number} index
     */
    removeItemByIndex(index) {
      this.textlist.splice(index, 1);
    },

    /**
     * Remove last text on backspace pressed
     */
    onBackspace() {
      if (!this.value && this.textlist.length) {
        this.textlist.pop();
      }
    },

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      if (this.isJsonString(this.field.value)) {
        const parsedtextlist = eval(this.field.value);
        this.textlist = Array.isArray(parsedtextlist) ? parsedtextlist : [];
        return;
      }
      if (Array.isArray(this.field.value)) {
        this.textlist = this.field.value;
        return;
      }

      this.textlist = [];
    },

    /**
     * Check string is valid JSON
     */
    isJsonString(str) {
      try {
        JSON.parse(str);
      } catch (e) {
        return false;
      }
      return true;
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(
        this.field.attribute,
        this.textlist.length ? JSON.stringify(this.textlist) : ""
      );
    },
  },
};
</script>
