<template>
    <div>
        <h1>Pedidos</h1>
        <form @submit.prevent="adicionarPedido">
            <input v-model="produto_id" type="number" placeholder="ID do produto" required>
            <input v-model="cliente_id" type="number" placeholder="ID do cliente" required>
            <input v-model="quantidade" type="number" placeholder="Quantidade" required>
            <button type="submit">Adicionar</button>
        </form>
        <ul>
            <li v-for="pedido in pedidos" :key="pedido.id">
                Produto ID: {{ pedido.produto_id }} - Cliente ID: {{ pedido.cliente_id }} - Quantidade: {{ pedido.quantidade }} - Valor Total: R$ {{ pedido.valor_total }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            pedidos: [],
            produto_id: '',
            cliente_id: '',
            quantidade: ''
        };
    },
    created() {
        this.buscarPedidos();
    },
    methods: {
        buscarPedidos() {
            axios.get('http://localhost:8000/api/pedidos')
                .then(response => {
                    this.pedidos = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        adicionarPedido() {
            axios.post('http://localhost:8000/api/pedidos', {
                produto_id: this.produto_id,
                cliente_id: this.cliente_id,
                quantidade: this.quantidade
            })
            .then(response => {
                this.pedidos.push(response.data);
                this.produto_id = '';
                this.cliente_id = '';
                this.quantidade = '';
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
}
</script>
