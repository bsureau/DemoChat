describe('DemoChat', function() {

    //FORMULAIRE DE CONNEXION
    it('chat_connection_nok', function(){
        cy.visit('http://0.0.0.0:8080/chat')
        expect(localStorage.getItem('nickname')).to.be.null
        cy.get('h1').contains('Demo Chat 😻')
    })

    it('chat_connection_ok', function(){
        cy.visit('http://0.0.0.0:8080')
        cy.get('.v-text-field__slot > input').type('Flig flug')
        cy.get('.v-btn').click().should(() => {
            expect(localStorage.getItem('nickname')).to.eq('Flig flug')
        })
    })

    it('chat_connection_nickname_empty', function(){
        cy.visit('http://0.0.0.0:8080')
        cy.get('.v-btn').should('have.class', 'v-btn--disabled')
    })

    it('chat_connection_nickname_too_long', function(){
        cy.visit('http://0.0.0.0:8080')
        cy.get('.v-text-field__slot > input').type('Flllllllig Fluuuuuuug')
        cy.get('.v-btn').should('have.class', 'v-btn--disabled')
        cy.get('.v-messages__message').contains('Your nickname must be less than 20 characters')
    })

    //CHAT
    it('chat_send_new_message_ok', function(){
        localStorage.setItem('nickname', 'Flig Flug')
        cy.visit('http://0.0.0.0:8080/chat')
        cy.get('.v-text-field__slot > textarea').type('Hello there!')
        cy.get('button').first().click()
        cy.get('.message-text').contains('Hello there!')
    })

    it('chat_send_like', function(){
        localStorage.setItem('nickname', 'Flig Flug')
        cy.visit('http://0.0.0.0:8080/chat')
        cy.get('button').eq(1).click()
    })

    it('chat_send_new_message_empty', function(){
        localStorage.setItem('nickname', 'Flig Flug')
        cy.visit('http://0.0.0.0:8080/chat')
        cy.get('button').first().should('have.class', 'v-btn--disabled')
    })

    it('chat_send_new_message_too_long', function(){
        localStorage.setItem('nickname', 'Flig Flug')
        cy.visit('http://0.0.0.0:8080/chat')
        cy.get('.v-text-field__slot > textarea').type('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id elementum purus, vel feugiat nibh. Duis accumsan vulputate blandit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean at nisi ante. Nam pharetra nunc vel dolor pretium consequat. Integer facilisis felis purus, vel gravida leo fermentum sit amet. Nullam ac ex auctor, ornare sapien vitae, condimentum erat. Nullam sed elementum ex, vitae aliquet ipsum. Sed interdum aliquet lorem in elementum. Donec eget magna eget nulla tempor ornare a eget mauris. Nullam semper aliquam ultrices. Pellentesque porttitor ligula sit amet ligula faucibus ultrices eget in nisi. Sed est metus, lobortis eget pharetra ac, consectetur eu ipsum. Aenean malesuada lacinia tincidunt. Ut vel felis porta, mollis quam sit amet, venenatis tellus. Sed erat turpis, scelerisque sed fermentum eu, suscipit a ante.\n' +
            '\n' +
            'Curabitur efficitur malesuada posuere. Vivamus finibus elementum arcu, ac fringilla neque lacinia non. Vivamus eu mattis erat, in consectetur urna. Phasellus eget nisl sed justo volutpat dapibus tristique eget eros. Nulla eu ante nulla. Aenean vitae aliquet arcu, et semper erat. Vivamus mattis pharetra mi, iaculis egestas nunc. Integer congue, lorem a consequat ultricies, dolor ligula lacinia ligula, sit amet finibus dui risus in risus. Cras eleifend sem vel porttitor tempus. Morbi est nulla, ullamcorper eget erat non, vestibulum condimentum orci. Fusce non lacus consectetur, rutrum dolor eu, dignissim felis. In est ligula, pretium a urna eu, tempus viverra urna. Ut condimentum nunc eget nibh dictum gravida. Proin non velit sit amet turpis ultricies bibendum ut ac velit. Sed sit amet justo ut odio tincidunt cursus vel a neque. Donec et orci non mi facilisis elementum in a magna.\n' +
            '\n')
        cy.get('button').first().should('have.class', 'v-btn--disabled')
    })
})
