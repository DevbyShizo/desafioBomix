import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../views/HomePage.vue';
import CategoriaList from '../views/CategoriaList.vue';
import EstabelecimentoList from '../views/EstabelecimentoList.vue';
import ProdutoList from '../views/ProdutoList.vue';
import PedidoList from '../views/PedidoList.vue';

const routes = [
    { path: '/', component: HomePage },
    { path: '/categorias', component: CategoriaList },
    { path: '/estabelecimentos', component: EstabelecimentoList },
    { path: '/produtos', component: ProdutoList },
    { path: '/pedidos', component: PedidoList },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
