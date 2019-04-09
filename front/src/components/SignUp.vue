<template>
  <v-form>
    <v-container>
      <v-layout row wrap justify-center>
        <v-flex xs4 md3>
          <v-form @submit="submit">
              <v-text-field
                      label="My Nickname"
                      counter="20"
                      :rules="nicknameRules"
                      v-model="nickname"
                      v-on:keyup.enter="submit"
                      v-on:keyup="isValid"
              ></v-text-field>
              <v-flex xs12>
                <v-btn flat :disabled="!valid" v-on:click="submit" color="info">Enter
                  <v-icon>chevron_right</v-icon>
                </v-btn>
              </v-flex>
          </v-form>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>
<script>
export default {
  name: 'SignUp',
  data: () => ({
      nickname: '',
      valid: false,
      nicknameRules : [
          v => v.length <= 20 || 'Your nickname must be less than 20 characters'
      ]
  }),
  methods: {
    isValid(){
        if(this.nickname.replace(/\s/g, '').length === 0 || this.nickname.trim().length > 20)
            this.valid=false
        else
            this.valid = true
    },
    submit(){
        if(this.valid === true){
            window.localStorage.setItem('nickname', this.nickname)
            this.$router.push('/chat')
        }
    }
  }
}
</script>
