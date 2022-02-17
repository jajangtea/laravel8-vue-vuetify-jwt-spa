import Axios from "@/utils/axios";

export default {
    namespaced: true,
    state: {
        periodes: [],
        errors: null
    },
    getters: {},
    mutations: {
        SET_POSTS(state, value) {
            state.periodes = value;
        },
        SET_ERRORS(state, value) {
            state.periodes = value;
        },
        SET_POST(state, value) {
            state.periodes.unshift(value);
        },
        SET_POST_UPDATED(state, value) {
            const index = state.periodes.findIndex(
                periode => periode.KodeJurusan === value
            );
            Vue.set(state.periodes, index, value);
        },
        SET_POST_DELETED(state, value) {
            const index = state.periodes.findIndex(
                periode => periode.KodeJurusan === value
            );
            state.periodes.splice(index, 1);
        }
    },
    actions: {
        deletePeriode({ commit }, payload) {
            Axios.delete("periode/" + payload)
                .then(res => {
                    commit("SET_POST_DELETED", payload);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        insertPeriode({ dispatch }, value) {
            Axios.post("periode", value)
                .then(response => {
                    dispatch("getPeriode");
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async getPeriode({ commit }) {
            try {
                const response = await Axios.get("/periode");
                let { data } = response.data;
                console.log(data);
                commit("SET_POSTS", data);
            } catch (error) {
                console.log(error);
            }
        },
        editPeriode({ commit }, value) {
            Axios.patch("periode/" + value.KodeJurusan, value.formData)
                .then(response => {
                    console.log(response);
                    commit("SET_POST_UPDATED", response.data.post);

                    if (store.state.errors !== null) {
                        commit("SET_ERRORS", null);
                    }
                })
                .catch(error => {
                    commit("SET_ERRORS", error.response.data.errors);
                });
        }
    }
};