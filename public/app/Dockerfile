# Fase de construcción
FROM node:18 as build
WORKDIR /app
COPY . .
RUN npm install && npm run build

# Fase de producción con Nginx
FROM nginx:alpine
COPY --from=build /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
