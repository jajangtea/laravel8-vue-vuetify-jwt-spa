<template>
  <div>
    <component
      v-for="(field, index) in schema"
      :key="index"
      :is="field.fieldType"
      :value="dataProdi[field.name]"
      @input="updateForm(field.name, $event)"
      v-bind="field"
    ></component>
  </div>
</template>

<script>
import TextInput from "./TextInput";
import DataTable from "./DataTable";

export default {
  name: "FormBuilder",
  components: {
    TextInput,
    DataTable
  },
  props: {
    value: {
      type: [Array],
      required: true
    },
    schema: {
      type: [Array],
      required: true
    }
  },

  data() {
    return {
      dataProdi: this.value || {}
    };
  },
  methods: {
    updateForm(fieldName, value) {
      this.$set(this.dataProdi, fieldName, value);
      this.$emit("input", this.dataProdi);
      console.log(
        "fieldName: " + fieldName + " |",
        "Value: " + value + " | from FormBuilder"
      );
    }
  }
};
</script>

<style scoped></style>
