module.exports = {
  // Tags are inherited by all posts.
  tags: ['pathItem', 'reliable'],
  path: {
    // Slug is used by landing pages like / and /learn to link to this path.
    // Because it affects urls, the slug should never be translated.
    slug: 'reliable',
    cover: '/images/collections/reliable.svg',
    title: 'Network reliability',
    updated: 'May 24, 2018',
    description: `See consistent, reliable performance regardless of network
    quality.`,
    overview: `The modern web gives you access to a diverse global audience
    with a range of devices and network connections. In this section you'll
    learn how to provide a consistently reliable experience to all your users,
    wherever and however they access the internet.`,
    topics: [
      {
        title: 'The options in your caching toolbox',
        pathItems: ['service-workers-cache-storage', 'workbox'],
      },
    ],
  },
};
