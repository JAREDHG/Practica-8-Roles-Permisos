<template>
  <div class="container mt-5">
    <h2>Catálogo de Productos</h2>
    
    <div class="row">
      <div class="col-md-3">
        <FiltrosPanel :filtros="filtros" />
      </div>

      <div class="col-md-9">
        <div class="row">
          <div class="col-md-4 mb-4" v-for="producto in resultado.data" :key="producto.id">
            <div class="card h-100 shadow-sm">
              <img 
                :src="producto.imagen_url || '/img/placeholder.png'" 
                class="card-img-top"
                style="height: 200px; object-fit: cover;"
              />
              <div class="card-body">
                <h5 class="card-title">{{ producto.nombre }}</h5>
                <p class="text-muted small mb-1">{{ producto.categoria?.nombre || 'Sin categoría' }}</p>
                <p class="card-text">${{ producto.precio }}</p>
                <button class="btn btn-primary btn-sm" @click="carrito.agregar(producto)">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <PaginacionNav 
          :meta="resultado.meta" 
          @cambio-pagina="filtros.pagina = $event" 
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'
import { useCarritoStore } from '../stores/carrito'
import { useFiltros } from '../composables/useFiltros'
import FiltrosPanel from '../components/FiltrosPanel.vue'
import PaginacionNav from '../components/PaginacionNav.vue'

const route = useRoute()
const carrito = useCarritoStore()
const { filtros } = useFiltros()
const resultado = ref({ data: [], meta: {} })

const cargarProductos = async () => {
  try {
    const { data } = await axios.get('http://localhost:8000/api/productos', {
      params: {
        busqueda:     filtros.busqueda,
        categoria_id: filtros.categoria_id,
        precio_min:   filtros.precio_min,
        precio_max:   filtros.precio_max,
        page:         filtros.pagina
      }
    })
    resultado.value = data
  } catch (error) {
    console.error('Error al cargar productos:', error)
  }
}

// Observa cambios en la URL (a través del composable) para recargar
watch(() => route.query, cargarProductos, { immediate: true })
</script>