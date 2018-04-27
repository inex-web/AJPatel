import 'whatwg-fetch';

const methodPOST = "POST";

const restPrefix = 'http://localhost/ajpatel/ajpatel-rest/api/';

const restHeaders = {
    'Access-Control-Allow-Origin': '*',
};

export function login(formData) {
    return fetch( restPrefix + 'login', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}

export function adminView(formData) {
    return fetch( restPrefix + 'admin_view', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}

export function adminEdit(formData) {
    return fetch( restPrefix + 'admin_edit', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}

export function partyList(formData) {
    return fetch( restPrefix + 'party_list', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}

export function partyView(formData) {
    return fetch( restPrefix + 'party_view', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}

export function partyEdit(formData) {
    return fetch( restPrefix + 'party_edit', {
        headers: restHeaders,
        method: methodPOST,
        body: formData
      })
}