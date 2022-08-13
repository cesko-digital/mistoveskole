import ParseError from '~/error/ParseError';

/**
 * @param {Response} response
 * @returns {Object}
 */
export default async function(response) {
  const body = await response.text();

  try {
    return JSON.parse(body);
  } catch (error) {
    throw new ParseError('failed to parse response json', error);
  }
}
