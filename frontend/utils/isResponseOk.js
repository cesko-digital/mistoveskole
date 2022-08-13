import ResponseError from '~/error/ResponseError';

/**
 * @param {Response} response
 * @returns {Response}
 */
export default function(response) {
  if (response.ok) {
    return response;
  } else {
    throw new ResponseError('response is not ok', response);
  }
}
