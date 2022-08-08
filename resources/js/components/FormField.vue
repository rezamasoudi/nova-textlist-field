<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
      <div
        class="masoudi-nova-textlist w-full form-control form-input form-input-bordered"
        :class="errorClasses"
      >
        <div
          v-for="(text, index) in textlist"
          :key="index"
          class="bg-primary-500 text-white dark:text-gray-800 text-item"
          v-text="text"
        ></div>
        <input
          :id="field.attribute"
          type="text"
          :placeholder="placeholder"
          v-model="value"
          @keyup.enter="onEnter"
          @keyup.backspace="onBackspace"
          @keypress.enter.prevent
        />
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
      }
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
