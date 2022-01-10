<template>
  <div>
    <div id="filtros" class="d-flex flex-column gap-3 mb-4">
      <div class="d-flex gap-3">
        <div class="d-flex align-items-center gap-3">
          <label>Provincia</label>
          <select id="provincia" class="form-select">
            <option value="bizkaia">Bizkaia</option>
            <option value="gipuzkoa">Gipuzkoa</option>
            <option value="araba">Araba</option>
          </select>
        </div>
        <div class="d-flex align-items-center gap-3">
          <label>Tipo</label>
          <select id="tipo" class="form-select">
            <option value="apartamento">Apartamento</option>
            <option value="hotel-apartamento">Hotel-Apartamento</option>
            <option value="hotel">Hotel</option>
            <option value="pension">Pension</option>
          </select>
        </div>
      </div>
      <div>
        <input type="text" class="form-control" placeholder="Buscar hoteles en euskadi">
      </div>
    </div>
    <div id="hoteles">
      <!-- HACER V-FOR CON EL SIGUIENTE DIV -->
      <div class="d-flex justify-content-between gap-3 border shadow-sm p-3">
        <div>
          <img src="img/default.png" style="max-width: 18rem;">
        </div>
        <div>
          <h3>Nombre Hotel</h3>
          <p>Deserunt deserunt quis enim consectetur laboris non culpa minim sit occaecat sit velit cupidatat velit. Consequat enim exercitation ut in cupidatat ullamco ut ipsum sunt veniam exercitation non aliquip ipsum. Lorem proident non sint mollit do sunt et excepteur non magna mollit proident nisi. Quis culpa nisi excepteur nisi quis do. Proident deserunt consectetur et esse do ad magna incididunt excepteur officia sint dolore nisi esse.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
      console.log("This is hotel.index component");
    },
  };
</script>
