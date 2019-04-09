<template>
  <v-container fluid fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12>
        <h1>Demo Chat 😻</h1>
        <em>Choose a nickname and start sending messages</em>
        <SignUp/>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
// @ is an alias to /src
import SignUp from '@/components/SignUp.vue'

export default {
  name: 'home',
  components: {
    SignUp
  }
}
</script>
<style>
</style>
