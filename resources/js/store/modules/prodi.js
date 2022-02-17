import Axios from "@/utils/axios";

export default {
    namespaced: true,
    state: {
        prodis: [],
        errors: null
    },
    getters: {},
    mutations: {
        SET_POSTS(state, value) {
            state.prodis = value;
        },
        SET_ERRORS(state, value) {
            state.prodis = value;
        },
        SET_POST(state, value) {
            state.prodis.unshift(value);
        },
        SET_POST_UPDATED(state, value) {
            const index = state.prodis.findIndex(
                prodi => prodi.KodeJurusan === value
            );
            Vue.set(state.prodis, index, value);
        },
        SET_POST_DELETED(state, value) {
            const index = state.prodis.findIndex(
                prodi => prodi.KodeJurusan === value
            );
            state.prodis.splice(index, 1);
        }
    },
    actions: {
        deleteProdi({ commit }, payload) {
            Axios.delete("prodi/" + payload)
                .then(res => {
                    commit("SET_POST_DELETED", payload);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        insertProdi({ dispatch }, value) {
            Axios.post("prodi", value)
                .then(response => {
                    dispatch("getProdi");
                })
                .catch(error => {
                    console.log(error);
                });
        },

        async getProdi({ commit }) {
            try {
                const response = await Axios.get("/prodi");
                let { data } = response.data;
                console.log(data);
                commit("SET_POSTS", data);
            } catch (error) {
                console.log(error);
            }
        },
        editProdi({ commit }, value) {
            Axios.patch("prodi/" + value.KodeJurusan, value.formData)
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