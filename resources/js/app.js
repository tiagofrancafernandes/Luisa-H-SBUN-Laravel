import './bootstrap';

import * as StringHelpers from '@/helpers/string-helpers';
import Toaster from '@/libs/toaster';

import Alpine from 'alpinejs';

let ToasterInstance = Toaster({});
ToasterInstance.loadListener();

window.Alpine = Alpine;
window.StringHelpers = StringHelpers;
window.Toaster = ToasterInstance;

Alpine.start();
