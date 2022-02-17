<template>
  <v-app-bar app clipped-left>
    <v-app-bar-nav-icon @click.stop="toggleDrawer()" />

    <v-toolbar-title style="cursor: pointer">
      <router-link v-slot="{ navigate }" :to="{ name: 'site-dashboard' }" custom>
        <span role="link" @click="navigate" @keypress.enter="navigate">
          SKKP
        </span>
      </router-link>

    </v-toolbar-title>

    <v-spacer />
    <v-btn to="/settings" icon>
      <v-icon>mdi-cog</v-icon>
    </v-btn>
    <v-btn icon @click="logout()">
      <v-icon>mdi-power-standby</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {
  name: "LayoutHeader",
  props: {
    drawer: Boolean,
  },
  methods: {
    toggleDrawer() {
      this.$emit("toggleDrawer");
    },
    navigate() {
      this.$emit("toggleDrawer");
    },
    logout() {
      this.$store.dispatch("auth/toggleLoggingOut", true);
      this.$store.dispatch("auth/logout").catch((err) => console.log(err));
    },
  },
};
</script>

<style scoped>
</style>
