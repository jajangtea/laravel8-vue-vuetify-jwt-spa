<template>
  <v-app>
    <template v-if="$store.state.auth.token">
      <v-navigation-drawer v-model="drawer" app clipped>
        <v-list dense>
          <v-list-item
            v-for="beranda in berandas"
            :key="beranda.title"
            :to="beranda.to"
            link
          >
            <v-list-item-icon>
              <v-icon>{{ beranda.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ beranda.title }}</v-list-item-title>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-group prepend-icon="mdi-account-check">
            <template v-slot:activator>
              <v-list-item-title>Pengguna</v-list-item-title>
            </template>
            <v-list-item
              v-for="admin in admins"
              :key="admin.title"
              :to="admin.to"
              link
            >
              <v-list-item-title>{{ admin.title }}</v-list-item-title>
              <v-list-item-icon>
                <v-icon>{{ admin.icon }}</v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>

          <v-list-group prepend-icon="mdi-gesture-double-tap">
            <template v-slot:activator>
              <v-list-item-title>Pendaftaran</v-list-item-title>
            </template>
            <v-list-item
              v-for="pendaftaran in pendaftarans"
              :key="pendaftaran.title"
              :to="pendaftaran.to"
              link
            >
              <v-list-item-title>{{ pendaftaran.title }}</v-list-item-title>
              <v-list-item-icon>
                <v-icon>{{ pendaftaran.icon }}</v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>

          <v-list-group prepend-icon="mdi-headset">
            <template v-slot:activator>
              <v-list-item-title>Penguji</v-list-item-title>
            </template>
            <v-list-item
              v-for="penguji in pengujis"
              :key="penguji.title"
              :to="penguji.to"
              link
            >
              <v-list-item-title>{{ penguji.title }}</v-list-item-title>
              <v-list-item-icon>
                <v-icon>{{ penguji.icon }}</v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>

          <v-list-group prepend-icon="mdi-account-key">
            <template v-slot:activator>
              <v-list-item-title>Pembimbing</v-list-item-title>
            </template>
            <v-list-item
              v-for="pembimbing in pembimbings"
              :key="pembimbing.title"
              :to="pembimbing.to"
              link
            >
              <v-list-item-title>{{ pembimbing.title }}</v-list-item-title>
              <v-list-item-icon>
                <v-icon>{{ pembimbing.icon }}</v-icon>
              </v-list-item-icon>
            </v-list-item>
          </v-list-group>

          <v-list-item
            v-for="item in items"
            :key="item.title"
            :to="item.to"
            link
          >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <layout-header :drawer="drawer" @toggleDrawer="drawer = !drawer" />
      <v-main v-if="!$store.state.auth.loggingOut">
        <router-view />
      </v-main>
      <layout-footer />
    </template>
    <template v-else>
      <v-main v-if="!$store.state.auth.loggingOut">
        <router-view />
      </v-main>
    </template>
  </v-app>
</template>

<script>
import LayoutHeader from "@/components/layout/layout-header";
import LayoutFooter from "@/components/layout/layout-footer";
export default {
  name: "SKKP",
  components: {
    "layout-header": LayoutHeader,
    "layout-footer": LayoutFooter
  },
  data: () => ({
    drawer: true,
    berandas: [{ title: "Home", icon: "mdi-home", to: "/" }],
    admins: [
      { title: "Dosen", icon: "mdi-account", to: "/abou" },
      { title: "Mahasiswa", icon: "mdi-account-multiple", to: "/about" },
      { title: "Penguji", icon: "mdi-account-convert", to: "/penguji" }
    ],

    pendaftarans: [
      { title: "Proposal", icon: "mdi-human-greeting", to: "/about" },
      { title: "Sidang", icon: "mdi-checkbox-marked-outline", to: "/about" }
    ],

    pembimbings: [
      { title: "Kerja Praktek", icon: "mdi-human-greeting", to: "/about" },
      { title: "Skripsi", icon: "mdi-checkbox-marked-outline", to: "/about" }
    ],

    pengujis: [
      { title: "Skripsi", icon: "mdi-human-greeting", to: "/about" },
      {
        title: "Kerja Praktek",
        icon: "mdi-checkbox-marked-outline",
        to: "/about"
      }
    ],

    items: [
      { title: "Jadwal Sidang", icon: "mdi-calendar-check", to: "/help" },
      { title: "Periode", icon: "mdi-calendar", to: "/periode" },
      { title: "Nilai", icon: "mdi-library", to: "/nilai" },
      { title: "Prodi", icon: "mdi-city", to: "/prodi" },
      { title: "Persyaratan", icon: "mdi-key-plus", to: "/persyaratan" },
      { title: "TA", icon: "mdi-calendar-clock", to: "/ta" }
    ]
  })
};
</script>
