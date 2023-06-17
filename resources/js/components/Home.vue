<template>
    <div class="card">
        <h1>~ TODO LİST ~</h1>
        <div class="card-form">
            <input
                type="text"
                placeholder="Todo Item Title"
                v-model="inputValues.title"
            />
            <input
                type="text"
                placeholder="Description"
                v-model="inputValues.description"
            />
            <button @click="addItem(inputValues)" type="submit">
                Add Item
            </button>
        </div>
        <!-- data table -->
        <table>
            <thead>
                <th>#</th>
                <th>title</th>
                <th>description</th>
                <th>operations</th>
            </thead>
            <tbody>
                <tr
                    v-for="todo in todoItems"
                    :class="todo.isTrue ? 'compated' : 'notcompated'"
                >
                    <td>{{ todo.id }}</td>
                    <td>{{ todo.title }}</td>
                    <td>{{ todo.description }}</td>
                    <td>
                        <a @click="compatedItem(todo.id)">{{
                            todo.isTrue ? "compated" : "not compated"
                        }}</a>
                        |
                        <a @click="deletedItem(todo.id)">Remove</a>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <th>#</th>
                <th>title</th>
                <th>description</th>
                <th>operations</th>
            </tfoot>
        </table>
        <!-- data table -->
    </div>
</template>
<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "Home",
    mounted() {
        this.getAllData();
    },
    data() {
        return {
            inputValues: {
                title: "",
                description: "",
            },
        };
    },
    computed: {
        ...mapState(["todoItems"]),
    },
    methods: {
        ...mapActions(["getAllData", "compatedItem", "deletedItem", "addItem"]),
    },
};
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Archivo:wght@500&display=swap");
#app {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Archivo", sans-serif;
}

.card {
    padding: 1rem;
    border: 0.5px solid black;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
}

.card .card-form {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.card input {
    border: 1px solid grey;
    outline: none;
    padding: 7px 15px;
    font-size: 1.1rem;
    border-radius: 5px;
}

.card input:nth-child(2) {
    margin: 0px 5px;
}

.card button {
    background: none;
    border: none;
    background-color: #00dfa2;
    padding: 10px 20px;
    border-radius: 5px;
    color: #f1f1f1;
    cursor: pointer;
    font-weight: 700;
    font-size: 1.1rem;
}

.card button:hover {
    background-color: #00f3b2;
}

.card h1 {
    color: #00dfa2;
    text-align: center;
}

.card table thead th {
    padding: 10px 20px;
}

.card table {
    margin-top: 5%;
}

.card table tbody tr td a {
    cursor: pointer;
}

.card table tbody tr td a:first-child {
    color: #00f3b2;
}

.card table tbody tr td a:nth-child(2) {
    color: red;
}

table,
th,
td {
    border: 1px solid black;
    border-collapse: collapse;
}

.card table tbody tr td {
    padding: 10px 20px;
    text-align: center;
}

.card ul li {
    margin: 10px;
}

.compated {
    background-color: #bbffed;
}
</style>
