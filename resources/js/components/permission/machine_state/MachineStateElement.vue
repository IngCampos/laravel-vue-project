  
<template>
  <tr>
    <td class="align-middle">{{machine.user_agent}}</td>
    <td class="align-middle text-center">
      <span
        :class="'badge badge-'+$root.colors[machine.machine_state.id-1]"
      >{{machine.machine_state.name}}</span>
    </td>
    <td class="align-middle text-center">{{machine.updated_at | date}}</td>
    <td class="align-middle text-right">
      <button
        v-if="machine.machine_state.id!=1"
        v-on:click="$emit('update', 1)"
        class="btn btn-success"
      >
        <i class="fas fa-hand-holding-water"></i>
      </button>
      <button
        v-if="machine.machine_state.id!=2"
        v-on:click="$emit('update', 2)"
        class="btn btn-warning"
      >
        <i class="fas fa-tools"></i>
      </button>
      <button
        v-if="machine.machine_state.id!=3"
        v-on:click="$emit('update', 3)"
        class="btn btn-danger"
      >
        <i class="fas fa-power-off"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["machine"],
};
</script>