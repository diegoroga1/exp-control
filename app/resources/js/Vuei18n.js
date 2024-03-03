import VueI18n from 'vue-i18n'
import locale from './locale'

//set messages localization
const messages = locale.getMessages()
const vuei18n = new VueI18n({locale: window.lang, messages})
export default vuei18n
