import {defineConfig} from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
    plugins: [react()],
    base: '/', // Asegura que los recursos se sirvan correctamente en producción
    server: {
        host: '0.0.0.0', // Permite que el contenedor escuche en todas las interfaces
        port: 5173, // Puerto por defecto de Vite
    },
})
