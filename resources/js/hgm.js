import * as masks from './utils/mask'
import userCreate from './pages/users/create'
import customerAddressCreate from './pages/customer-address/create'
import pmocCreate from './pages/pmoc/create';
import orderServiceCreate from './pages/order-service/create';
import applianceIndex from './pages/appliance/index'
import reportAppliance from './pages/reportAppliance';
import reportCustomer from './pages/reportCustomer';
import applianceCreate from './pages/appliance/index'

const HGM = {
    pages: {
        customerAddress: {
            create: customerAddressCreate,
        },
        users: {
            create: userCreate,
        },
        pmoc: {
            create: pmocCreate,
        },
        orderService: {
            create: orderServiceCreate
        },
        appliance: {
            index: applianceIndex,
            create: applianceCreate
        },
        reportAppliance,
        reportCustomer,
    },
    utils: {
        masks
    }
}

export default HGM;
