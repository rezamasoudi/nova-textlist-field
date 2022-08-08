<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <div v-if="textlist.length" class="masoudi-nova-textlist">
        <div
          v-for="(text, index) in textlist"
          :key="index"
          class="bg-primary-500 text-white dark:text-gray-800 text-item"
          v-text="text"
        ></div>
      </div>
      <div v-else>---</div>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ["index", "resource", "resourceName", "resourceId", "field"],

  computed: {

    textlist() {
      const textlist = eval(this.field.value);
      return Array.isArray(textlist) ? textlist : [];
    },
  },
};
</script>
