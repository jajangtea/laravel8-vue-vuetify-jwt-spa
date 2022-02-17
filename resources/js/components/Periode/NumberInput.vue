<template>
  <div :hidden="hidden">
    <v-text-field
      type="number"
      :name="name"
      :value="value"
      :label="label"
      :placeholder="placeholder"
      :color="color"
      @input.native="$emit('input', $event.target.value)"
    ></v-text-field>
  </div>
</template>

<script>
export default {
  name: "NumberInput",
  props: ["name", "value", "label", "placeholder", "color", "hidden"]
};
</script>

<style scoped></style>
