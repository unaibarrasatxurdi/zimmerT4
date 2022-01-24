<template>
  <div class="comment d-flex align-items-top gap-4 mb-3">
      <div class="mt-1">
          <div class="user-icon bg-secondary">
            <span class="initials">{{ this.usuario.initials }}</span>
          </div>
      </div>
      <div class="d-flex flex-column w-100">
        <div class="d-flex justify-content-between">
          <div class="d-flex gap-2">
              <span class="username fw-bold">{{ this.usuario.name }}</span>
              <span class="text-muted">{{ this.comentario.created_at }}</span>
          </div>
          <form v-bind:action="'/komentarioa/' + this.comentario.id" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="hotel_id" :value="this.comentario.hotel_id">
            <button type="submit" class="del-btn">X</button>
          </form>
        </div>
        <p class="content">{{ this.comentario.contenido }}</p>
      </div>
  </div>
</template>

<script>
export default {

  props: ['comentario', 'usuario'],

};
</script>
