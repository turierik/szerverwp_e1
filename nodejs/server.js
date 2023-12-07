const fastify = require('fastify')({
  logger: true
})
const { User, Post } = require('./models')

fastify.get('/', async (request, reply) => {
  reply.type('application/json').code(200)
  return { hello: 'világocska' }
})

fastify.get('/posts', async (request, reply) => {
    const posts = await Post.findAll()
    reply.send(posts)
})


fastify.get('/posts/:id', async (request, reply) => {
    const p = await Post.findByPk(request.params.id)
    if (p === null)
        return reply.status(404).send("NOT FOUND")
    reply.send(p)
})

fastify.post('/posts', async (request, reply) => {
    const p = await Post.create(request.body)
    reply.status(201).send(p)
})

fastify.patch('/posts/:id', async (request, reply) => {
    const p = await Post.findByPk(request.params.id)
    if (p === null)
        return reply.status(404).send("NOT FOUND")
    await p.update(request.body)
    reply.send(p)
})

fastify.delete('/posts/:id', async (request, reply) => {
    const p = await Post.findByPk(request.params.id)
    if (p === null)
        return reply.status(404).send("NOT FOUND")
    await p.destroy()
    reply.send("DELETED")
})

fastify.delete('/posts', async (request, reply) => {
    await Post.destroy({ truncate: true })
    reply.send("DELETED")
})

fastify.listen({ port: 3000 }, (err, address) => {
  if (err) throw err
  // Server is now listening on ${address}
})