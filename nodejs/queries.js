const { User, Post } = require('./models')
const { Op } = require('sequelize')

console.print = (data) => console.log(JSON.parse(JSON.stringify(data, null, 2)))

;(async () => {
    const allPosts = await Post.findAll()
    // console.print(allPosts)

    const postsBy2 = await Post.findAll({
        where: {
            authorId: 2
        }
    })
    // console.print(postsBy2)

    const postsBy2or8 = await Post.findAll({
        where: {
            authorId: {
                [Op.or]: [2, 8]
            }
        }
    })
    // console.print(postsBy2or8)

    const postsOr = await Post.findAll({
        where: {
            [Op.or]: {
                authorId: 2,
                id: 2
            }
        }
    })
    // console.print(postsOr)

    const posts10to15 = await Post.findAll({
        where: {
            id: {
                [Op.gt]: 10,
                [Op.lt]: 15
            }
        }
    })
    // console.print(posts10to15)

    const postsCount = await Post.count()
    // console.print(postsCount)

    const postsByAuthor = await Post.count({
        group: ['authorId']
    })
    // console.print(postsByAuthor)

    const user4 = await User.findByPk(4)
    const postsBy4 = await user4.getPosts()
    // console.print(postsBy4)

    const postsWithUser = await Post.findAll({
        include: [{ model: User }]
    })
    console.print(postsWithUser)
})()