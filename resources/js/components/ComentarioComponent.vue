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
        <div class="d-flex gap-2 align-items-center">
          <div v-if="this.usuario.rol == 1 || this.comentario.user_id == this.usuario.id" v-bind:action="'/komentarioa/' + this.comentario.id" method="POST">
            <button type="submit" class="edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fa fa-edit fs-5 text-muted"></i>
            </button>
          </div>
          <form v-if="this.usuario.rol == 1 || this.comentario.user_id == this.usuario.id" v-bind:action="'/komentarioa/' + this.comentario.id" method="POST">
            <input type="hidden" name="_token" :value="csrf">
            <!-- <input type="hidden" name="hotel_id" :value="this.comentario.hotel_id"> -->
            <input type="hidden" name="next_url" :value="'/hoteles/' + this.comentario.hotel_id">
            <button type="submit" class="del-btn">X</button>
          </form>
        </div>
      </div>
      <p class="content">{{ this.comentario.contenido }}</p>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form v-bind:action="'/komentarioa/' + this.comentario.id" method="POST" class="modal-content">
          <div class="modal-header d-flex justify-content-between">
            <div class="d-flex gap-3 align-items-center">
              <div class="user-icon bg-success">
                <span class="initials">{{ this.usuario.initials }}</span>
              </div>
              <div class="d-flex flex-column ">
                <span class="username fw-bold">{{ this.usuario.name }}</span>
                <span class="text-muted">{{ this.comentario.updated_at }}</span>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="method" value="UPDATE">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="next_url" :value="'/hoteles/' + this.comentario.hotel_id">
            <textarea name="contenido" class="form-control" v-bind:value="comentario.contenido | trim"></textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Gorde aldaketak</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  mounted: function() {
    console.log(this.comentario.user_id, this.usuario.id, this.comentario.user_id == this.usuario.id);  
  },

  props: ['comentario', 'usuario'],

  filters: {
    trim: function (text) {
      return text.trim();
    },
  }

};
</script>
