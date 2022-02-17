<template>
  <v-container class="ma-2 pa-0" grid-list-sm>
    <template>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Kode</th>
              <th class="text-left">Nama Jurusan</th>
              <th class="text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ prodi.KodeJurusan }}</td>
              <td>{{ prodi.NamaJurusan }}</td>
              <td>
                <v-btn
                  small
                  depressed
                  color="info"
                  :to="'/prodi/' + prodi.KodeJurusan + '/edit'"
                >
                  Edit
                  <v-icon right dark> mdi-pencil </v-icon>
                </v-btn>


                <v-btn
                  small
                  depressed
                  color="error"
                  @click.stop="dialogs.delete = true"
                >
                  Delete
                  <v-icon right dark> mdi-delete </v-icon>
                </v-btn>
              </td>
            </tr>
          </tbody>
        </template>
      </v-simple-table>

      <edit-prodi
        v-if="dialogs.add"
        @close="dialogs.add = false"
        :prodi="prodi"
      />
      <delete-prodi
        v-if="dialogs.delete"
        @close="dialogs.delete = false"
        :prodi="prodi"
      />
    </template>

    <v-divider></v-divider>
  </v-container>
</template>

<script>
export default {
  props: ["prodi"],

  components: {
    "delete-prodi": require("@/components/dialogs/deleteProdi.vue").default,
    "edit-prodi": require("@/components/dialogs/editProdiDialog.vue").default
  },

  data() {
    return {
        search: '',
      headers: [
        {
          text: "Dessert (100g serving)",
          align: "start",
          filterable: false,
          value: "name"
        },
        { text: "Calories", value: "calories" },
        { text: "Fat (g)", value: "fat" },
        { text: "Carbs (g)", value: "carbs" },
        { text: "Protein (g)", value: "protein" },
        { text: "Iron (%)", value: "iron" }
      ],
      dialogs: {
        add: false,
        delete: false
      }
    };
  }
};
</script>

<style></style>
