export const actions = {
  nuxtServerInit(context, nuxtServerInitProps) {
    context.dispatch('map/nuxtServerInit', nuxtServerInitProps);
  },
};
