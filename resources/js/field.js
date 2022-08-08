import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-masoudi-tags-field', IndexField)
  app.component('detail-masoudi-tags-field', DetailField)
  app.component('form-masoudi-tags-field', FormField)
})
