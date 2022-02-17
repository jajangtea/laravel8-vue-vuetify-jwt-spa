<template>
  <v-data-table
    :headers="headers"
    :items="tabItems"
    class="elevation-1"
    :mobile-breakpoint="820"
    :disableSort="true"
    :disablePagination="true"
    :disableFiltering="true"
    :hideDefaultHeader="false"
    :hideDefaultFooter="true"
    :form-data="dataProdi"
    :schema="schema"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>{{ addHeading }}</v-toolbar-title>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" x-small fab dark elevation="3" class="ml-2" v-on="on">
              <v-icon dark>mdi-plus</v-icon>
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <!-- start: this don't work -->
              <v-form>
                <form-builder v-bind:schema="schema.dialogItems" v-model="editedItem"/>
              </v-form>
              <!-- end: this don't work -->
              <!-- start: this works -->
              <!--<v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                    <v-text-field v-model="editedItem.amount" type="number" label="Amount"></v-text-field>
                    <v-radio-group label="Treatment" v-model="editedItem.treatment">
                      <v-radio label="Yes" value="Yes"></v-radio>
                      <v-radio label="No" value="No"></v-radio>
                    </v-radio-group>
                  </v-col>
                </v-row>
              </v-container>-->
              <!-- end: this works -->
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.action="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)">mdi-lead-pencil</v-icon>
      <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
    </template>
    <template v-slot:no-data>
      <span>{{ nodata }}</span>
    </template>
  </v-data-table>
</template>

<script>
export default {
  components: { FormBuilder: () => import("./FormBuilder") },
  props: [
    "schema",
    "formData",
    "name",
    "value",
    "headers",
    "nodata",
    "addHeading",
    "confirmDeleteTabItem",
    "tableTitleOptionA",
    "tableTitleOptionB",
    "items"
  ],
  data: () => ({
    dialog: false,
    editedIndex: -1,
    editedItem: {},
    defaultItem: {}
  }),

  computed: {
    computedFormData: {
      get: function() {
        return this.$parent.dataProdi;
      },
      set: function() {
        return this.dataProdi;
      }
    },

    tabItems: {
      get: function() {
        return this.$parent.dataProdi.items;
      },
      set: function() {
        return this.items;
      }
    },

    formTitle() {
      return this.editedIndex === -1
        ? this.tableTitleOptionA
        : this.tableTitleOptionB;
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  methods: {
    editItem(item) {
      this.editedIndex = this.tabItems.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.tabItems.indexOf(item);
      confirm(this.confirmDeleteTabItem) && this.tabItems.splice(index, 1);
    },

    close() {
      this.dialog = false;
      // setTimeout(() => {
      this.editedItem = Object.assign({}, this.defaultItem);
      this.editedIndex = -1;
      // }, 3000);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.tabItems[this.editedIndex], this.editedItem);
      } else {
        this.tabItems.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
