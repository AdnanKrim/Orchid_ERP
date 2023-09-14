
import './bootstrap';
import { createApp } from 'vue';
import CreateCart from './components/CreateCart.vue';
import MenuPermission from './components/MenuPermission';
import measureCart from "./components/measureCart";
import AddPurchase from "./components/AddPurchase";
import UpdatePurchase from "./components/UpdatePurchase";
import ReturnPurchase from "./components/ReturnPurchase";
import AddLabour from "./components/AddLabour";
import Toaster from '@meforma/vue-toaster';
import addAccount from "./components/addAccount";
import addGeneralJournal from "./components/addGeneralJournal";
import addColorQty from "./components/addColorQty";
import addAccountChart from "./components/addAccountChart";
import salesReport from "./components/salesReport";
import addAdjustingJournal from "./components/addAdjustingJournal";
import projectEstimate from "./components/projectEstimate";

//without week/month
// import VueDatepickerUi from 'vue-datepicker-ui'
// import 'vue-datepicker-ui/lib/vuedatepickerui.css';

//with week/month
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const app = createApp({});
app.component('create-cart', CreateCart);
app.component('menu-permission', MenuPermission);
app.component('measure-cart', measureCart);
app.component('add-purchase', AddPurchase);
app.component('update-purchase', UpdatePurchase);
app.component('return-purchase',ReturnPurchase);
app.component('add-labour', AddLabour);
app.component('add-account', addAccount);
app.component('add-general-journal', addGeneralJournal);
app.component('add-adjusting-journal', addAdjustingJournal);
app.component('add-color-qty', addColorQty);
app.component('add-account-chart', addAccountChart);
app.component('sales-report', salesReport);
app.component('add-estimate', projectEstimate);

// app.component('Datepicker', VueDatepickerUi);
app.component('Datepicker', Datepicker);


app.use(Toaster).mount('#app');

// const abc = createApp({});
// abc.component('create-purchases', CreatePurchase);
// abc.mount('#prc');

