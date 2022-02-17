<template>
  <v-container fluid>
    <v-breadcrumbs :items="items">
      <template v-slot:divider>
        <v-icon>mdi-forward</v-icon>
      </template>
    </v-breadcrumbs>
    <v-divider></v-divider>
    <v-card class="ma-2 pa-2">
      <v-card-title>
        SKKP
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="this.$store.state.periode.periodes"
        :search="search" class="ma-2 pa-2"
      >
        <template #item.index="{ item }">
          {{ $store.state.periode.periodes.indexOf(item) + 1 }}
        </template>
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Periode</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
                >
                  New Item
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-menu
                          ref="menu"
                          v-model="menu"
                          :close-on-content-click="false"
                          :return-value.sync="date"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="editedItem.tglPeriode"
                              label="Picker in menu"
                              prepend-icon="mdi-calendar"
                              readonly
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker v-model="editedItem.tglPeriode" no-title scrollable>
                            <v-spacer></v-spacer>
                            <v-btn text color="primary" @click="menu = false">
                              Cancel
                            </v-btn>
                            <v-btn
                              text
                              color="primary"
                              @click="$refs.menu.save(date)"
                            >
                              OK
                            </v-btn>
                          </v-date-picker>
                        </v-menu>
                      </v-col>

                    </v-row>
                  </v-container>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                    >OK</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
        </template>
      </v-data-table>
    </v-card>
  </v-container>
</template>

<script type="text/javascript">
import { mapGetters, mapActions } from "vuex";
import Axios from "@/utils/axios";
export default {

  //   created() {
  //     if (!User.loggedIn()) {
  //       this.$router.push({ name: "/" });
  //     }
  //   },

  data() {
    return {

      menu: false,
      editedIndex: -1,
      search: "",
      headers: [
        {
          value: "index",
          text: "#",
        },
        {
          text: "Tanggal",
          align: "start",
          filterable: false,
          value: "tglPeriode",
        },

        { text: "Actions", value: "actions", sortable: false },
      ],

      dialog: false,
      dialogDelete: false,
      editedItem: {
        tglPeriode: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      },
      dialogs: {
        add: false,
      },
      items: [
        {
          text: "Dashboard",
          disabled: false,
          href: "/",
        },
        {
          text: "Periode",
          disabled: true,
          href: "/periode",
        },
      ],
    };
  },

  methods: {
    initialize() {
      this.$store.state.periode.periodes = [
        {
          tglPeriode: this.tglPeriode,
        },
      ];
    },
    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    deleteItemConfirm() {
      //this.$store.state.periode.periodes.splice(this.editedIndex, 1);
      this.$store.dispatch("periode/deletePeriode", this.editedItem.tglPeriode);
      this.getPeriode();
      this.closeDelete();
    },

    incrementIndex(key) {
      return key + 1;
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(
          this.$store.state.periode.periodes[this.editedIndex],
          this.editedItem
        );

        console.log(this.editedItem.tglPeriode);
        Axios.put(`periode/${this.editedItem.tglPeriode}`, {
          tglPeriode: this.editedItem.tglPeriode,
        })
          .then((res) => {
            this.getPeriode();
          })
          .catch((err) => {
            console.log(err);
          });
        // }
      } else {
        this.$store.dispatch("periode/insertPeriode", this.editedItem);
        // this.$store.state.periode.periodes.push(this.editedItem);
      }
      this.close();
    },

    editItem(item) {
      this.editedIndex = this.$store.state.periode.periodes.indexOf(item);
      this.editedItem = Object.assign({}, item);
      // console.log(item.KodeJurusan)
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.$store.state.periode.periodes.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    getPeriode() {
      this.$store.dispatch("periode/getPeriode");
    },
  },
  beforeRouteLeave(to, from, next) {
    if (this.$store.state.errors !== null) {
      const answer = window.confirm("Yakin meninggalkan halaman?");
      if (answer) {
        this.$store.commit("SET_ERRORS", null);
      } else {
        return;
      }
    }
    next();
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  created() {
    this.initialize();
    this.getPeriode();
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
};
</script>

<style type="text/css"></style>
