FROM node:lts

WORKDIR "/app"

COPY package*.json ./

RUN npm install
RUN npm audit fix --force

COPY . .

RUN npm run

EXPOSE 3000

CMD ["npm", "run", "dev", "start"]