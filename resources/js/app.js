import './bootstrap';
import 'preline';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import SignaturePad from "signature_pad";

window.SignaturePad = SignaturePad;

Livewire.start();
