require("./bootstrap");

import { createApp } from "vue";
import Home from "./components/Home.vue";
import store from "./store/store";

const app = createApp({});
app.use(store);

app.component("home", Home);

app.mount("#app");
