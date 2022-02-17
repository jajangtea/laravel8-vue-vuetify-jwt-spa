<template>
  <div>
    <v-radio-group :row="this.row" v-model="picked" :label="label">
      <v-radio
        v-for="(item, idx) in items"
        :key="idx"
        :value="item.value"
        :label="item.label"
        :name="name"
        :color="color"
        ripple
        @input="$emit('input', $event.target.value)"
      ></v-radio>
    </v-radio-group>
  </div>
</template>

<script>
export default {
  name: "RadioInput",
  props: ["name", "label", "items", "value", "color"],

  data() {
    return {
      picked: this.value
    };
  },
  watch: {
    picked: function() {
      this.$emit("input", this.picked);
    }
  },
  computed: {
    row() {
      return this.$vuetify.breakpoint.mdAndUp;
    }
  }
};
</script>

<style scoped></style>
