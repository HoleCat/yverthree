<template>
  <div v-html="require(`./../../svg/icon-${icon}.svg`)"></div>
</template>

<script>
export default {
    props: ['icon']
}
</script>