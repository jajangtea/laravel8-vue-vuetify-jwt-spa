<template>
  <div>
    <v-text-field
      :name="name"
      :value="value"
      :label="label"
      :hint="hint"
      :placeholder="placeholder"
      :append-icon="icon"
      :color="color"
      :class="{ 'mb-6': hint }"
      @input.native="$emit('input', $event.target.value)"
    ></v-text-field>
  </div>
</template>

<script>
export default {
  name: "TextInput",
  props: ["name", "value", "label", "placeholder", "icon", "color", "hint"]
};
</script>

<style scoped></style>
