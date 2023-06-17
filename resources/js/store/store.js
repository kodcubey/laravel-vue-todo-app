import { createStore } from "vuex";

const store = new createStore({
    state: {
        todoItems: [],
    },
    getters: {},
    mutations: {
        setTodoItems(state, data) {
            state.todoItems = data;
        },
    },
    actions: {
        async getAllData({ commit }, item) {
            await fetch("http://127.0.0.1:8000/get-all-data")
                .then((response) => response.json())
                .then((data) => {
                    commit("setTodoItems", data);
                })
                .catch((err) => console.log(err));
        },

        async compatedItem({ commit }, id) {
            await fetch(`http://127.0.0.1:8000/completed-item/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    commit("setTodoItems", data);
                })
                .catch((err) => console.log(err));
        },

        async deletedItem({ commit }, id) {
            await fetch(`http://127.0.0.1:8000/delete-item/${id}`)
                .then((response) => response.json())
                .then((data) => {
                    commit("setTodoItems", data);
                })
                .catch((err) => console.log(err));
        },

        async addItem({ commit }, data) {
            console.log(data);
            await fetch(`http://127.0.0.1:8000/add-item`, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                method: "POST",
                body: JSON.stringify({
                    title: data.title,
                    description: data.description,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data.errors);
                    if (data.errors) {
                        alert("fail");
                    } else {
                        commit("setTodoItems", data);
                    }
                })
                .catch((err) => console.log(err));
        },
    },
});

export default store;
